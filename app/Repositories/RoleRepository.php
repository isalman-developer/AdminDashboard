<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleRepository
{
    /**
     * List roles with optional search, ordered by name.
     *
     * @return LengthAwarePaginator<int, Role>
     */
    public function paginate(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return Role::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('guard_name', 'like', "%{$search}%");
        })
            ->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Find a role by primary key.
     */
    public function find(int $id): ?Role
    {
        return Role::find($id);
    }

    /**
     * Find a role by name.
     */
    public function findByName(string $name): ?Role
    {
        return Role::where('name', $name)->first();
    }

    /**
     * Create a new role.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Role
    {
        return Role::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web',
        ]);
    }

    /**
     * Update a role's name.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Role $role, array $data): Role
    {
        $role->update(['name' => $data['name']]);
        return $role;
    }

    /**
     * Delete a role.
     */
    public function delete(Role $role): bool
    {
        try {
            return $role->delete();
        } catch (\Exception) {
            return false;
        }
    }

    /**
     * Get all permissions grouped by category.
     *
     * @return \Illuminate\Support\Collection<string, \Illuminate\Support\Collection<int, \Spatie\Permission\Models\Permission>>
     */
    public function allPermissionsGrouped()
    {
        return \Spatie\Permission\Models\Permission::orderBy('name')->get()->groupBy('category');
    }

    /**
     * Get a role's permission IDs.
     *
     * @return array<int, int>
     */
    public function getPermissionIds(Role $role): array
    {
        return $role->permissions->pluck('id')->toArray();
    }

    /**
     * Return all roles ordered by name.
     *
     * @return \Illuminate\Support\Collection<int, Role>
     */
    public function allOrdered()
    {
        return Role::orderBy('name')->get();
    }

    /**
     * Sync permissions on a role.
     *
     * @param  array<int>|null  $permissionIds
     */
    public function syncPermissions(Role $role, ?array $permissionIds): void
    {
        if ($permissionIds !== null && count($permissionIds) > 0) {
            $permissions = \Spatie\Permission\Models\Permission::whereIn('id', $permissionIds)->get();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }
    }
}
