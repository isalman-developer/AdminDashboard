<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RoleService $roleService)
    {
        $search = $request->get('search');
        $roles = $roleService->paginate($search);

        return view('admin.roles.index', compact('roles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoleService $roleService)
    {
        $permissions = $roleService->allPermissionsGrouped();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request, RoleService $roleService)
    {
        $validated = $request->validated();
        $permissionIds = $validated['permissions'] ?? null;

        $roleService->create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ], $permissionIds);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role, RoleService $roleService)
    {
        $role = $roleService->findWithPermissions($role->id);

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role, RoleService $roleService)
    {
        $permissions = $roleService->allPermissionsGrouped();
        $rolePermissions = $roleService->getPermissionIds($role);

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role, RoleService $roleService)
    {
        $validated = $request->validated();
        $permissionIds = $validated['permissions'] ?? null;

        $roleService->update($role, ['name' => $validated['name']], $permissionIds);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role, RoleService $roleService)
    {
        try {
            $roleService->delete($role);
            return response()->json(['success' => true, 'message' => 'Role deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete role: ' . $e->getMessage()], 500);
        }
    }
}
