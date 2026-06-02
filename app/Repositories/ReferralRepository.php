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

    /** Columns fetched in referral queries — avoids pulling sensitive/heavy columns in tree traversals. */
    private const TREE_COLUMNS = ['id', 'name', 'email', 'referral_code', 'parent_id', 'status', 'created_at'];

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
        return User::select(self::TREE_COLUMNS)
            ->where('parent_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAncestry(User $user): Collection
    {
        $ancestors = new Collection();
        $currentId = $user->parent_id;

        while ($currentId !== null) {
            $current = User::select(self::TREE_COLUMNS)->find($currentId);

            if ($current === null) {
                break;
            }

            $ancestors->push($current);
            $currentId = $current->parent_id;
        }

        return $ancestors;
    }

    public function getDescendants(User $user): Collection
    {
        $descendants = new Collection();
        $queue = [$user->id];

        while (! empty($queue)) {
            $parentId = array_shift($queue);
            $children = User::select(self::TREE_COLUMNS)
                ->where('parent_id', $parentId)
                ->get();

            foreach ($children as $child) {
                $descendants->push($child);
                $queue[] = $child->id;
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
