<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

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
     * Create a new user with safe defaults for system-managed fields.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): User
    {
        return User::create([
            'name'              => $data['name'],
            'username'          => $data['username'] ?? null,
            'email'             => $data['email'],
            'password'          => $data['password'],
            'referral_code'     => $this->generateUniqueReferralCode(),
            'parent_id'         => null,
            'wallet_balance'    => 0,
            'email_verified_at' => null,
            'status'            => $data['status'],
        ]);
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

    private function generateUniqueReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }
}
