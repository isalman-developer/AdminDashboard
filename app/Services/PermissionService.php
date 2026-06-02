<?php

namespace App\Services;

use App\Models\Permission;
use App\Repositories\PermissionRepository;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $repository
    ) {}

    /**
     * Paginate permissions with optional search.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator<int, Permission>
     */
    public function paginate(string $search = '', int $perPage = 15)
    {
        return $this->repository->paginate($search, $perPage);
    }

    /**
     * Get a permission by ID.
     */
    public function find(int $id): ?Permission
    {
        return $this->repository->find($id);
    }

    /**
     * Create a new permission.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Permission
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing permission.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Permission $permission, array $data): Permission
    {
        $this->repository->update($permission, [
            'name'     => $data['name'],
            'category' => $data['category'] ?? '',
        ]);

        return $permission;
    }

    /**
     * Delete a permission.
     */
    public function delete(Permission $permission): bool
    {
        return $this->repository->delete($permission);
    }

    /**
     * Get all permissions ordered by name.
     *
     * @return \Illuminate\Support\Collection<int, Permission>
     */
    public function allOrdered()
    {
        return $this->repository->allOrdered();
    }

    /**
     * Get roles associated with a permission.
     *
     * @return \Illuminate\Support\Collection<int, \Spatie\Permission\Models\Role>
     */
    public function getRoles(Permission $permission)
    {
        return $this->repository->getRoles($permission);
    }
}
