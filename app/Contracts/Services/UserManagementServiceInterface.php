<?php

namespace App\Contracts\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserManagementServiceInterface
{
    public function paginateWithFilters(string $search = '', ?string $roleFilter = null, ?string $statusFilter = null, int $perPage = 15): LengthAwarePaginator;
    public function allRolesOrdered(): Collection;
    public function loadRelationships(User $user): User;
    public function allPermissionsGrouped(): Collection;
    public function syncRolesAndPermissions(User $user, ?array $roleIds, ?array $permissionIds): void;
    public function createUser(array $data): User;
    public function updateProfile(User $user, array $data): User;
    public function removeRole(User $user, string $roleName): void;
    public function removePermission(User $user, string $permissionName): void;
}
