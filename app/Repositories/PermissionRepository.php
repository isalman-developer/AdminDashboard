<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Pagination\LengthAwarePaginator;

class PermissionRepository
{
    /**
     * List permissions with optional search, ordered by name.
     *
     * @return LengthAwarePaginator<int, Permission>
     */
    public function paginate(string $search = '', int $perPage = 15): LengthAwarePaginator
    {
        return Permission::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
        })
            ->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Find a permission by primary key.
     */
    public function find(int $id): ?Permission
    {
        return Permission::find($id);
    }

    /**
     * Create a new permission.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Permission
    {
        return Permission::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web',
            'category' => $data['category'] ?? '',
        ]);
    }

    /**
     * Update an existing permission.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Permission $permission, array $data): Permission
    {
        $permission->update([
            'name' => $data['name'],
            'category' => $data['category'] ?? '',
        ]);

        return $permission;
    }

    /**
     * Delete a permission.
     */
    public function delete(Permission $permission): bool
    {
        try {
            return $permission->delete();
        } catch (\Exception) {
            return false;
        }
    }

    /**
     * Get all permissions ordered by name.
     *
     * @return \Illuminate\Support\Collection<int, Permission>
     */
    public function allOrdered()
    {
        return Permission::orderBy('name')->get();
    }

    /**
     * Get the roles attached to a permission.
     *
     * @return \Illuminate\Support\Collection<int, \Spatie\Permission\Models\Role>
     */
    public function getRoles(Permission $permission)
    {
        return $permission->roles;
    }
}
