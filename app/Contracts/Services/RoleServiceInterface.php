<?php

namespace App\Contracts\Services;

use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RoleServiceInterface
{
    public function paginate(string $search = '', int $perPage = 10): LengthAwarePaginator;
    public function findWithPermissions(int $id): ?Role;
    public function create(array $data, ?array $permissionIds = null): Role;
    public function update(Role $role, array $data, ?array $permissionIds = null): Role;
    public function delete(Role $role): bool;
    public function allPermissionsGrouped(): Collection;
    public function getPermissionIds(Role $role): array;
    public function allOrdered(): Collection;
}
