<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\User\UserRoleUpateRequest;
use App\Models\User;
use App\Services\UserManagementService;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users with their roles.
     */
    public function index(Request $request, UserManagementService $userManagementService)
    {
        $search = $request->get('search');
        $roleFilter = $request->get('role');
        $statusFilter = $request->get('status');

        $users = $userManagementService->paginateWithFilters($search, $roleFilter, $statusFilter);
        $roles = $userManagementService->allRolesOrdered();

        return view('admin.users.index', compact('users', 'roles', 'search', 'roleFilter', 'statusFilter'));
    }

    /**
     * Show the form for editing user roles and permissions.
     */
    public function editRoles(User $user, UserManagementService $userManagementService)
    {
        $user = $userManagementService->loadRelationships($user);
        $roles = $userManagementService->allRolesOrdered();
        $permissions = $userManagementService->allPermissionsGrouped();

        return view('admin.users.edit_roles', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update user roles and permissions.
     */
    public function updateRoles(UserRoleUpateRequest $request, User $user, UserManagementService $userManagementService)
    {
        $validated = $request->validated();

        $userManagementService->syncRolesAndPermissions(
            $user,
            $validated['roles'] ?? null,
            $validated['permissions'] ?? null,
        );

        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'User roles and permissions updated successfully.');
    }

    /**
     * Remove specified role from user.
     */
    public function removeRole(Request $request, User $user, UserManagementService $userManagementService)
    {
        $userManagementService->removeRole($user, request()->route('role')->name);

        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'Role removed successfully.');
    }

    /**
     * Remove specified permission from user.
     */
    public function removePermission(Request $request, User $user, UserManagementService $userManagementService)
    {
        $userManagementService->removePermission($user, request()->route('permission')->name);

        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'Permission removed successfully.');
    }
}
