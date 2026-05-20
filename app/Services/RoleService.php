<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function __construct(
        protected RoleRepository $repository,
        protected PermissionRepository $permissionRepository,
    ) {}

    /**
     * Paginate roles with optional search.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator<int, Role>
     */
    public function paginate(string $search = '', int $perPage = 10)
    {
        return $this->repository->paginate($search, $perPage);
    }

    /**
     * Get a role by ID with permissions loaded (delegated to repository).
     */
    public function findWithPermissions(int $id): ?Role
    {
        return $this->repository->findWithPermissions($id);
    }

    /**
     * Create a new role and optionally sync permissions.
     *
     * @param  array<string, mixed>  $data
     * @param  array<int>|null  $permissionIds
     */
    public function create(array $data, ?array $permissionIds = null): Role
    {
        return DB::transaction(function () use ($data, $permissionIds): Role {
            $role = $this->repository->create($data);
            $this->repository->syncPermissions($role, $this->resolvePermissions($permissionIds));

            return $role;
        });
    }

    /**
     * Update a role name and optionally sync permissions.
     *
     * @param  array<string, mixed>  $data
     * @param  array<int>|null  $permissionIds
     */
    public function update(Role $role, array $data, ?array $permissionIds = null): Role
    {
        return DB::transaction(function () use ($role, $data, $permissionIds): Role {
            $this->repository->update($role, $data);
            $this->repository->syncPermissions($role, $this->resolvePermissions($permissionIds));

            return $role;
        });
    }

    /**
     * Resolve an array of permission IDs to Permission models.
     * Returns an empty collection when no IDs are provided.
     *
     * @param  array<int>|null  $permissionIds
     * @return Collection<int, \Spatie\Permission\Models\Permission>
     */
    private function resolvePermissions(?array $permissionIds): Collection
    {
        if (empty($permissionIds)) {
            return collect();
        }

        return $this->permissionRepository->findByIds($permissionIds);
    }

    /**
     * Create a role from the validated form payload, applying the default guard.
     *
     * @param  array<string, mixed>  $validated
     */
    public function createFromValidated(array $validated): Role
    {
        return $this->create(
            ['name' => $validated['name'], 'guard_name' => 'web'],
            $validated['permissions'] ?? null,
        );
    }

    /**
     * Update a role from the validated form payload.
     *
     * @param  array<string, mixed>  $validated
     */
    public function updateFromValidated(Role $role, array $validated): Role
    {
        return $this->update(
            $role,
            ['name' => $validated['name']],
            $validated['permissions'] ?? null,
        );
    }

    /**
     * Delete a role.
     */
    public function delete(Role $role): bool
    {
        return $this->repository->delete($role);
    }

    /**
     * Get all permissions grouped by category for a form.
     *
     * @return \Illuminate\Support\Collection<string, \Illuminate\Support\Collection<int, \Spatie\Permission\Models\Permission>>
     */
    public function allPermissionsGrouped()
    {
        return $this->repository->allPermissionsGrouped();
    }

    /**
     * Get a role's permission IDs.
     *
     * @return array<int, int>
     */
    public function getPermissionIds(Role $role): array
    {
        return $this->repository->getPermissionIds($role);
    }

    /**
     * Return all roles ordered by name.
     *
     * @return \Illuminate\Support\Collection<int, Role>
     */
    public function allOrdered()
    {
        return $this->repository->allOrdered();
    }
}
