<?php

namespace App\Contracts\Services;

use App\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PermissionServiceInterface
{
    public function paginate(string $search = '', int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Permission;
    public function create(array $data): Permission;
    public function update(Permission $permission, array $data): Permission;
    public function delete(Permission $permission): bool;
    public function allOrdered(): Collection;
    public function getRoles(Permission $permission): Collection;
}
