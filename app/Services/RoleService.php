<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function __construct(
        protected RoleRepository $repository
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
     * Get a role by ID with permissions loaded.
     */
    public function findWithPermissions(int $id): ?Role
    {
        $role = $this->repository->find($id);
        if ($role) {
            $role->load('permissions');
        }

        return $role;
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
            $this->repository->syncPermissions($role, $permissionIds);

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
            $this->repository->syncPermissions($role, $permissionIds);

            return $role;
        });
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
