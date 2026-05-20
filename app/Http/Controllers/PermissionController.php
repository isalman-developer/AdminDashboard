<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Permission\PermissionStoreRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;
use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    public function index(Request $request, PermissionService $permissionService): View
    {
        $search      = (string) ($request->get('search') ?? '');
        $permissions = $permissionService->paginate($search);

        return view('admin.permissions.index', compact('permissions', 'search'));
    }

    public function create(): View
    {
        return view('admin.permissions.create');
    }

    public function store(PermissionStoreRequest $request, PermissionService $permissionService): RedirectResponse
    {
        $permissionService->create($request->validated());

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission, PermissionService $permissionService): View
    {
        $roles = $permissionService->getRoles($permission);

        return view('admin.permissions.show', compact('permission', 'roles'));
    }

    public function edit(Permission $permission): View
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission, PermissionService $permissionService): RedirectResponse
    {
        $permissionService->update($permission, $request->validated());

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission, PermissionService $permissionService): JsonResponse
    {
        $permissionService->delete($permission);

        return response()->json(['success' => true, 'message' => 'Permission deleted successfully.']);
    }
}
