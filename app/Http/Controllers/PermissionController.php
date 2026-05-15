<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Permission\PermissionStoreRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PermissionService $permissionService)
    {
        $search = $request->get('search');
        $permissions = $permissionService->paginate($search);

        return view('admin.permissions.index', compact('permissions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionStoreRequest $request, PermissionService $permissionService)
    {
        $permissionService->create($request->validated());

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $permission, PermissionService $permissionService)
    {
        $permission = $permissionService->find($permission);
        $roles = $permissionService->getRoles($permission);

        return view('admin.permissions.show', compact('permission', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $permission, PermissionService $permissionService)
    {
        $permission = $permissionService->find($permission);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $request, int $permission, PermissionService $permissionService)
    {
        $permissionService->update($permissionService->find($permission), $request->validated());

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $permission, PermissionService $permissionService)
    {
        $model = $permissionService->find($permission);
        $success = $permissionService->delete($model);

        if (! $success) {
            return response()->json(['success' => false, 'message' => 'Failed to delete permission.'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Permission deleted successfully']);
    }
}
