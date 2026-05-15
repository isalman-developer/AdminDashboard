<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserRoleUpateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users with their roles.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $roleFilter = $request->get('role');
        $statusFilter = $request->get('status');

        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%");
        })
            ->when($roleFilter, function ($query) use ($roleFilter) {
                return $query->whereHas('roles', function ($q) use ($roleFilter) {
                    $q->where('name', $roleFilter);
                });
            })
            ->when($statusFilter, function ($query) use ($statusFilter) {
                return $query->where('status', $statusFilter);
            })
            ->with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles', 'search', 'roleFilter', 'statusFilter'));
    }

    /**
     * Show the form for editing user roles and permissions.
     */
    public function editRoles(User $user)
    {
        $user->load('roles', 'permissions');
        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get()->groupBy('category');

        return view('admin.users.edit_roles', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update user roles and permissions.
     */
    public function updateRoles(UserRoleUpateRequest $request, User $user)
    {
        $validated = $request->validated();

        // Sync roles
        if (isset($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        } else {
            $user->syncRoles([]);
        }

        // Sync direct permissions
        if (isset($validated['permissions'])) {
            $user->syncPermissions($validated['permissions']);
        } else {
            $user->syncPermissions([]);
        }

        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'User roles and permissions updated successfully.');
    }

    /**
     * Remove specified role from user.
     */
    public function removeRole(Request $request, User $user, Role $role)
    {
        $user->removeRole($role->name);
        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'Role removed successfully.');
    }

    /**
     * Remove specified permission from user.
     */
    public function removePermission(Request $request, User $user, Permission $permission)
    {
        $user->removePermission($permission->name);
        return redirect()->route('admin.users.edit-roles', $user)
            ->with('success', 'Permission removed successfully.');
    }
}
