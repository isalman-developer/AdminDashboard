<?php

namespace App\Services;

use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Contracts\Services\UserManagementServiceInterface;
use App\Models\User;
use App\Repositories\UserRepository;

class UserManagementService implements UserManagementServiceInterface
{
    public function __construct(
        protected UserRepository $repository,
        protected RoleRepositoryInterface $roleRepository,
        protected PermissionRepositoryInterface $permissionRepository,
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
        return $this->roleRepository->allOrdered();
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
        return $this->permissionRepository->allOrdered()->groupBy('category');
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
     * Create a new user with the given validated data.
     * Generates a unique referral_code and sets safe defaults for
     * parent_id and wallet_balance.
     *
     * @param  array<string, mixed>  $data
     */
    public function createUser(array $data): User
    {
        return $this->repository->create($data);
    }

    /**
     * Update basic profile fields on a user (name, username, email, status).
     * Does NOT touch password, referral_code, parent_id, or wallet_balance.
     *
     * @param  array<string, mixed>  $data
     */
    public function updateProfile(User $user, array $data): User
    {
        return $this->repository->updateProfile($user, $data);
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
