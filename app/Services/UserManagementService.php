<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Repositories\UserRepository;

class UserManagementService
{
    public function __construct(
        protected UserRepository $repository
    ) {}

    /**
     * Get paginated users with optional search / role / status filters.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator<int, User>
     */
    public function paginateWithFilters(
        string $search = '',
        ?string $roleFilter = null,
        ?string $statusFilter = null,
        int $perPage = 15
    ) {
        return $this->repository->paginateWithFilters($search, $roleFilter, $statusFilter, $perPage);
    }

    /**
     * Return all roles, ordered by name — for filter dropdowns.
     *
     * @return \Illuminate\Support\Collection<int, Role>
     */
    public function allRolesOrdered()
    {
        return Role::orderBy('name')->get();
    }

    /**
     * Load a user's roles and permissions (eager).
     */
    public function loadRelationships(User $user): User
    {
        $user->load('roles', 'permissions');
        return $user;
    }

    /**
     * Get all permissions grouped by category — for assignment forms.
     *
     * @return \Illuminate\Support\Collection<string, \Illuminate\Support\Collection<int, Permission>>
     */
    public function allPermissionsGrouped()
    {
        return Permission::orderBy('name')->get()->groupBy('category');
    }

    /**
     * Sync roles and direct permissions on a user.
     *
     * @param  array<int>|null  $roleIds
     * @param  array<int>|null  $permissionIds
     */
    public function syncRolesAndPermissions(User $user, ?array $roleIds, ?array $permissionIds): void
    {
        $user->syncRoles($roleIds ?? []);
        $user->syncPermissions($permissionIds ?? []);
    }

    /**
     * Remove a role from a user.
     */
    public function removeRole(User $user, string $roleName): void
    {
        $user->removeRole($roleName);
    }

    /**
     * Remove a direct permission from a user.
     */
    public function removePermission(User $user, string $permissionName): void
    {
        $user->removePermission($permissionName);
    }
}
