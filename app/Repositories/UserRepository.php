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

    public function authUser(): User
    {
        return auth()->user();
    }

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

    public function create(array $data): User
    {
        return User::create($data);
    }

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

    public function updatePassword(User $user, string $hashedPassword): User
    {
        $user->password = $hashedPassword;
        $user->save();

        return $user;
    }
}
