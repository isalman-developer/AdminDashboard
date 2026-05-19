<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function authUser(): User;
    public function find(int $id): ?User;
    public function paginateWithFilters(string $search = '', ?string $roleFilter = null, ?string $statusFilter = null, int $perPage = 15): LengthAwarePaginator;
    public function create(array $data): User;
    public function updateProfile(User $user, array $data): User;
    public function updatePassword(User $user, string $hashedPassword): User;
}
