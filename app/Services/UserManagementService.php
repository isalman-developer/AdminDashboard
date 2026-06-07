<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class UserManagementService
{
    public function __construct(
        protected UserRepository $repository,
        protected RoleRepository $roleRepository,
        protected PermissionRepository $permissionRepository,
    ) {}

    public function paginateWithFilters(
        string $search = '',
        ?string $roleFilter = null,
        ?string $statusFilter = null,
        int $perPage = 15
    ) {
        return $this->repository->paginateWithFilters($search, $roleFilter, $statusFilter, $perPage);
    }

    public function allRolesOrdered(): \Illuminate\Support\Collection
    {
        return $this->roleRepository->allOrdered();
    }

    public function loadRelationships(User $user): User
    {
        $user->load('roles', 'permissions');

        return $user;
    }

    public function allPermissionsGrouped(): \Illuminate\Support\Collection
    {
        return $this->permissionRepository->allOrdered()->groupBy('category');
    }

    public function syncRolesAndPermissions(User $user, ?array $roleIds, ?array $permissionIds): void
    {
        DB::transaction(function () use ($user, $roleIds, $permissionIds): void {
            $this->performRolePermissionSync($user, $roleIds, $permissionIds);
        });
    }

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

    public function createUser(array $data): User
    {
        return $this->repository->create([
            'name'              => $data['name'],
            'username'          => $data['username'] ?? null,
            'email'             => $data['email'],
            'password'          => $data['password'],
            'email_verified_at' => null,
            'status'            => $data['status'],
        ]);
    }

    private function performRolePermissionSync(User $user, ?array $roleIds, ?array $permissionIds): void
    {
        $user->syncRoles($roleIds ?? []);
        $user->syncPermissions($permissionIds ?? []);
    }

    public function updateProfile(User $user, array $data): User
    {
        return $this->repository->updateProfile($user, $data);
    }

    public function removeRole(User $user, string $roleName): void
    {
        $user->removeRole($roleName);
    }

    public function removePermission(User $user, string $permissionName): void
    {
        $user->removePermission($permissionName);
    }
}
