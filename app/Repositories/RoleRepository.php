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

    /** @param array<int>|null $permissionIds */
    public function syncPermissions(Role $role, ?array $permissionIds): void
    {
        $permissions = ($permissionIds !== null && count($permissionIds) > 0)
            ? \Spatie\Permission\Models\Permission::whereIn('id', $permissionIds)->get()
            : [];

        $role->syncPermissions($permissions);
    }
}
