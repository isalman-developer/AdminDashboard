<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    protected function model(): string
    {
        return User::class;
    }

    /**
     * Return the authenticated user.
     */
    public function authUser(): User
    {
        return auth()->user();
    }

    /**
     * List users with optional search, role filter, and status filter.
     * Roles are eagerly loaded.
     *
     * @return LengthAwarePaginator<int, User>
     */
    public function paginateWithFilters(
        string $search = '',
        ?string $roleFilter = null,
        ?string $statusFilter = null,
        int $perPage = 15
    ): LengthAwarePaginator {
        return User::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->when($roleFilter, function ($query) use ($roleFilter) {
                return $query->whereHas('roles', function ($q) use ($roleFilter) {
                    $q->where('name', $roleFilter);
                });
            })
            ->when($statusFilter, fn ($q) => $q->where('status', $statusFilter))
            ->with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Persist a fully-prepared user data array. Callers are responsible
     * for supplying all required fields including referral_code and defaults.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Check whether a referral code is already taken.
     */
    public function referralCodeExists(string $code): bool
    {
        return User::where('referral_code', $code)->exists();
    }

    /**
     * Update basic profile fields (name, username, email, status).
     *
     * @param  array<string, mixed>  $data
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (! empty($data['username'])) {
            $user->username = $data['username'];
        }

        if (! empty($data['status'])) {
            $user->status = $data['status'];
        }

        $user->save();

        return $user;
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(User $user, string $hashedPassword): User
    {
        $user->password = $hashedPassword;
        $user->save();

        return $user;
    }

}
