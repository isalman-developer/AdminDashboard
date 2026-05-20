<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Role\RoleStoreRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(Request $request, RoleService $roleService): View
    {
        $search = (string) ($request->get('search') ?? '');
        $roles  = $roleService->paginate($search);

        return view('admin.roles.index', compact('roles', 'search'));
    }

    public function create(RoleService $roleService): View
    {
        $permissions = $roleService->allPermissionsGrouped();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(RoleStoreRequest $request, RoleService $roleService): RedirectResponse
    {
        $roleService->createFromValidated($request->validated());

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role, RoleService $roleService): View
    {
        $role = $roleService->findWithPermissions($role->id);

        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role, RoleService $roleService): View
    {
        $permissions     = $roleService->allPermissionsGrouped();
        $rolePermissions = $roleService->getPermissionIds($role);

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(RoleUpdateRequest $request, Role $role, RoleService $roleService): RedirectResponse
    {
        $roleService->updateFromValidated($role, $request->validated());

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role, RoleService $roleService): JsonResponse
    {
        $roleService->delete($role);

        return response()->json(['success' => true, 'message' => 'Role deleted successfully.']);
    }
}
