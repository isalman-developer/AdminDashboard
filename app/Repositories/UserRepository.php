<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Return the authenticated user.
     */
    public function authUser(): User
    {
        return auth()->user();
    }

    /**
     * Find a user by primary key.
     */
    public function find(int $id): ?User
    {
        return User::find($id);
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
            ->when($statusFilter, function ($query) use ($statusFilter) {
                return $query->where('status', $statusFilter);
            })
            ->with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage ?? env('PAGINATION_PER_PAGE', 15))
            ->withQueryString();
    }

    /**
     * Create a new user with safe defaults for system-managed fields.
     *
     * referral_code  — auto-generated unique code
     * parent_id      — null (no upline assigned at creation)
     * wallet_balance — 0.00
     * email_verified — null
     * status         — active
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'] ?? null,
            'email' => $data['email'],
            'password' => $data['password'],
            'referral_code' => $this->generateUniqueReferralCode(),
            'parent_id' => null,
            'wallet_balance' => 0,
            'email_verified_at' => null,
            'status' => $data['status'],
        ]);
    }

    /**
     * Generate a unique referral code that does not already exist.
     */
    private function generateUniqueReferralCode(): string
    {
        do {
            $code = strtoupper(\Illuminate\Support\Str::random(8));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Update basic profile fields on a user.
     * Only name, username, email, and status are updatable here.
     * Password, referral_code, parent_id, and wallet_balance must be updated
     * through their dedicated flows.
     *
     * @param  array<string, mixed>  $data
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->name = $data['name'];
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
