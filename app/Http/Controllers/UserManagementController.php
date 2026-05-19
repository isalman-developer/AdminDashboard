<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\UserRoleUpdateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\UserManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users with their roles.
     */
    public function index(Request $request, UserManagementService $userManagementService): View
    {
        $search = $request->get('search') ?? '';
        $roleFilter = $request->get('role') ?? null;
        $statusFilter = $request->get('status') ?? null;

        $users = $userManagementService->paginateWithFilters($search, $roleFilter, $statusFilter);
        $roles = $userManagementService->allRolesOrdered();

        return view('admin.users.index', compact('users', 'roles', 'search', 'roleFilter', 'statusFilter'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(CreateUserRequest $request, UserManagementService $userManagementService): RedirectResponse
    {
        $validated = $request->validated();

        $user = $userManagementService->createUser($validated);

        if (! empty($validated['roles'])) {
            $userManagementService->syncRolesAndPermissions($user, $validated['roles'], []);
        }

        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'User created and roles assigned successfully.');
    }

    /**
     * Show the form for editing a user's basic profile fields.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the user's basic profile fields.
     * Only name, username, email, and status are updated here.
     */
    public function update(UserUpdateRequest $request, User $user, UserManagementService $userManagementService): RedirectResponse
    {
        $validated = $request->validated();

        $userManagementService->updateProfile($user, $validated);

        return redirect()->route('admin.users.edit', $user)
            ->with('success', 'User profile updated successfully.');
    }

    /**
     * Show the form for editing user roles and permissions.
     */
    public function editRoles(User $user, UserManagementService $userManagementService): View
    {
        $user = $userManagementService->loadRelationships($user);
        $roles = $userManagementService->allRolesOrdered();
        $permissions = $userManagementService->allPermissionsGrouped();

        return view('admin.users.edit_roles', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update user roles and permissions.
     */
    public function updateRoles(UserRoleUpdateRequest $request, User $user, UserManagementService $userManagementService): RedirectResponse
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
    public function removeRole(User $user, Role $role, UserManagementService $userManagementService): RedirectResponse
    {
        $userManagementService->removeRole($user, $role->name);

        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'Role removed successfully.');
    }

    /**
     * Remove specified permission from user.
     */
    public function removePermission(User $user, Permission $permission, UserManagementService $userManagementService): RedirectResponse
    {
        $userManagementService->removePermission($user, $permission->name);

        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'Permission removed successfully.');
    }
}
