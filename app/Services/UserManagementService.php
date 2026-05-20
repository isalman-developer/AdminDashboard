<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserManagementService
{
    public function __construct(
        protected UserRepository $repository,
        protected RoleRepository $roleRepository,
        protected PermissionRepository $permissionRepository,
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
    public function allRolesOrdered(): \Illuminate\Support\Collection
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
    public function allPermissionsGrouped(): \Illuminate\Support\Collection
    {
        return $this->permissionRepository->allOrdered()->groupBy('category');
    }

    /**
     * Sync roles and direct permissions on a user.
     * Both pivot table writes are wrapped in one DB::transaction() so
     * either both succeed or both are rolled back.
     *
     * @param  array<int>|null  $roleIds
     * @param  array<int>|null  $permissionIds
     */
    public function syncRolesAndPermissions(User $user, ?array $roleIds, ?array $permissionIds): void
    {
        DB::transaction(function () use ($user, $roleIds, $permissionIds): void {
            $this->performRolePermissionSync($user, $roleIds, $permissionIds);
        });
    }

    /**
     * Create a new user and assign initial roles in one atomic transaction.
     *
     * @param  array<string, mixed>  $data
     */
    public function createUserWithRoles(array $data): User
    {
        return DB::transaction(function () use ($data): User {
            $user = $this->createUser($data);

            if (! empty($data['roles'])) {
                $this->performRolePermissionSync($user, $data['roles'], []);
            }

            return $user;
        });
    }

    /**
     * Create a new user. Generates a unique referral_code and enforces
     * safe defaults for system-managed fields (parent_id, wallet_balance, etc.).
     *
     * @param  array<string, mixed>  $data
     */
    public function createUser(array $data): User
    {
        return $this->repository->create([
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
     * Generate a referral code that is guaranteed unique in the users table.
     */
    private function generateUniqueReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while ($this->repository->referralCodeExists($code));

        return $code;
    }

    /**
     * Inner sync body shared by syncRolesAndPermissions and createUserWithRoles.
     * Must only be called from within an existing DB::transaction().
     *
     * @param  array<int>|null  $roleIds
     * @param  array<int>|null  $permissionIds
     */
    private function performRolePermissionSync(User $user, ?array $roleIds, ?array $permissionIds): void
    {
        $user->syncRoles($roleIds ?? []);
        $user->syncPermissions($permissionIds ?? []);
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
