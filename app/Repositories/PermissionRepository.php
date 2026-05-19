<?php

namespace App\Repositories;

use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected function model(): string
    {
        return Permission::class;
    }

    /** @return LengthAwarePaginator<int, Permission> */
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

    public function create(array $data): Permission
    {
        return Permission::create([
            'name'       => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web',
            'category'   => $data['category'] ?? '',
        ]);
    }

    public function update(Permission $permission, array $data): Permission
    {
        $permission->update([
            'name'     => $data['name'],
            'category' => $data['category'] ?? '',
        ]);

        return $permission;
    }

    /** @return Collection<int, Permission> */
    public function allOrdered(): Collection
    {
        return Permission::orderBy('name')->get();
    }

    /** @return EloquentCollection<int, \Spatie\Permission\Models\Role> */
    public function getRoles(Permission $permission): EloquentCollection
    {
        return $permission->roles;
    }
}
