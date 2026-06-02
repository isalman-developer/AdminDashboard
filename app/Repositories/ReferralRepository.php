<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ReferralRepository extends BaseRepository
{
    protected function model(): string
    {
        return User::class;
    }

    public function findByReferralCode(string $code): ?User
    {
        return User::where('referral_code', $code)->first();
    }

    public function referralCodeExists(string $code): bool
    {
        return User::where('referral_code', $code)->exists();
    }

    public function getDirectReferrals(User $user): Collection
    {
        return User::where('parent_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAncestry(User $user): Collection
    {
        $ancestors = collect();
        $current = $user->parent;

        while ($current !== null) {
            $ancestors->push($current);
            $current = $current->parent;
        }

        return $ancestors;
    }

    public function getDescendants(User $user): Collection
    {
        $descendants = collect();
        $queue = collect([$user]);

        while ($queue->isNotEmpty()) {
            $current = $queue->shift();
            $children = $current->children;

            foreach ($children as $child) {
                $descendants->push($child);
                $queue->push($child);
            }
        }

        return $descendants;
    }

    public function isInAncestryOf(User $ancestorCandidate, User $user): bool
    {
        $ancestors = $this->getAncestry($user);

        return $ancestors->contains('id', $ancestorCandidate->id);
    }
}
