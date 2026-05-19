<?php

namespace App\Contracts\Repositories;

use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function paginate(string $search = '', int $perPage = 10): LengthAwarePaginator;
    public function find(int $id): ?Role;
    public function findByName(string $name): ?Role;
    public function create(array $data): Role;
    public function update(Role $role, array $data): Role;
    public function delete(Role $role): bool;
    public function allPermissionsGrouped(): Collection;
    public function getPermissionIds(Role $role): array;
    public function allOrdered(): Collection;
    public function syncPermissions(Role $role, ?array $permissionIds): void;
}
