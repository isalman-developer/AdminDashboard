<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ReferralRepository;
use Illuminate\Support\Str;

class ReferralService
{
    public function __construct(
        protected ReferralRepository $repository,
    ) {}

    public function generateUniqueReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while ($this->repository->referralCodeExists($code));

        return $code;
    }

    public function findSponsorByCode(string $code): ?User
    {
        return $this->repository->findByReferralCode($code);
    }

    private function ensureNotSelfReferral(User $sponsor, User $registeringUser): void
    {
        if ($sponsor->id === $registeringUser->id) {
            throw new \InvalidArgumentException('Self-referral is not allowed.');
        }
    }

    private function ensureNoCircularChain(User $sponsor, User $registeringUser): void
    {
        if ($this->repository->isInAncestryOf($registeringUser, $sponsor)) {
            throw new \InvalidArgumentException('Circular referral chain is not allowed.');
        }
    }

    public function validateForRegistration(User $sponsor, User $user): void
    {
        $this->ensureNotSelfReferral($sponsor, $user);
        $this->ensureNoCircularChain($sponsor, $user);
        $this->validateSponsorForNewUser($sponsor);
    }

    public function validateSponsorForNewUser(?User $sponsor): void
    {
        if ($sponsor === null) {
            return;
        }

        if ($sponsor->status === 'blocked') {
            throw new \InvalidArgumentException('Sponsor account is blocked.');
        }
    }

    public function buildReferralLink(string $referralCode): string
    {
        $path = config('app.referral_register_path', '/register');

        return url($path . '?ref=' . $referralCode);
    }

    public function getReferralTree(User $user): array
    {
        $ancestors = $this->repository->getAncestry($user);
        $children = $this->repository->getDirectReferrals($user);

        return [
            'user' => $user,
            'ancestors' => $ancestors,
            'children' => $children,
        ];
    }
}
