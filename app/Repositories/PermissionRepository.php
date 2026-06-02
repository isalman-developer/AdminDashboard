<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PermissionRepository extends BaseRepository
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

    /** @return Collection<int, Permission> */
    public function allOrdered(): Collection
    {
        return Permission::orderBy('name')->get();
    }

    /**
     * Fetch permission models by a list of IDs.
     *
     * @param  array<int>  $ids
     * @return Collection<int, Permission>
     */
    public function findByIds(array $ids): Collection
    {
        return Permission::whereIn('id', $ids)->get();
    }

    /** @return EloquentCollection<int, \Spatie\Permission\Models\Role> */
    public function getRoles(Permission $permission): EloquentCollection
    {
        return $permission->roles;
    }
}
