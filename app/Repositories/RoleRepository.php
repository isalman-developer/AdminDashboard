<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RoleRepository extends BaseRepository
{
    protected function model(): string
    {
        return Role::class;
    }

    /** @return LengthAwarePaginator<int, Role> */
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

    public function findByName(string $name): ?Role
    {
        return Role::where('name', $name)->first();
    }

    /**
     * Find a role by ID with permissions eagerly loaded.
     */
    public function findWithPermissions(int $id): ?Role
    {
        return Role::with('permissions')->find($id);
    }

    public function create(array $data): Role
    {
        return Role::create([
            'name'       => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web',
        ]);
    }

    /** @return Collection<string, Collection<int, \Spatie\Permission\Models\Permission>> */
    public function allPermissionsGrouped(): Collection
    {
        return \Spatie\Permission\Models\Permission::orderBy('name')->get()->groupBy('category');
    }

    /** @return array<int, int> */
    public function getPermissionIds(Role $role): array
    {
        return $role->permissions->pluck('id')->toArray();
    }

    /** @return Collection<int, Role> */
    public function allOrdered(): Collection
    {
        return Role::orderBy('name')->get();
    }

    /**
     * Sync resolved Permission models onto a role.
     *
     * @param  iterable<\Spatie\Permission\Models\Permission>  $permissions
     */
    public function syncPermissions(Role $role, iterable $permissions): void
    {
        $role->syncPermissions($permissions);
    }
}
