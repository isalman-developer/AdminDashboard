@extends('admin.layouts.admin')

@section('title', 'Manage User Roles & Permissions')

@section('content')
    <div class="row">
        <!-- User Info Column -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">User Information</h4>
                </div>
                <div class="card-body text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td style="width: 120px;"><strong>Username</strong></td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    @if ($user->status === 'active')
                                        <span class="badge bg-label-success">Active</span>
                                    @elseif($user->status === 'inactive')
                                        <span class="badge bg-label-secondary">Inactive</span>
                                    @else
                                        <span class="badge bg-label-warning">{{ ucfirst($user->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Wallet</strong></td>
                                <td>${{ number_format($user->wallet_balance, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Joined</strong></td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Roles & Permissions Column -->
        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.users.update-roles', $user) }}">
                @csrf
                @method('PUT')

                <!-- Roles Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti ti-shield me-2"></i>Assign Roles
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Select one or more roles to assign to this user</p>

                        <div class="mb-3">
                            <div class="row g-2">
                                @forelse($roles as $role)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-check card p-3">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                id="role-{{ $role->id }}" value="{{ $role->name }}"
                                                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                            <label class="form-check-label w-100" for="role-{{ $role->id }}">
                                                <span class="fw-semibold">{{ $role->name }}</span>
                                                @if ($role->permissions->count() > 0)
                                                    <br><small class="text-muted">{{ $role->permissions->count() }}
                                                        permission(s)</small>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted">No roles available. <a
                                                href="{{ route('admin.roles.create') }}">Create a role first</a>.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Direct Permissions Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="icon-base ti tabler-key me-2"></i>Direct Permissions
                </h4>
                <small class="text-muted ms-2">(Granted directly to user, bypassing roles)</small>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Additional permissions that are not covered by assigned roles</p>

                @if ($permissions->count() > 0)
                    <div class="mb-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="select-all-permissions-user">
                            <label class="form-check-label" for="select-all-permissions-user">
                                <strong>Select All Permissions</strong>
                            </label>
                        </div>
                    </div>

                    @foreach ($permissions as $category => $perms)
                        @if ($category)
                            <div class="mb-3">
                                <h6 class="text-uppercase text-muted small fw-bold mb-2">{{ $category }}</h6>
                                <div class="row g-2">
                                    @foreach ($perms as $permission)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-check">
                                                <input class="form-check-input permission-checkbox" type="checkbox"
                                                    name="permissions[]" id="permission-{{ $permission->id }}"
                                                    value="{{ $permission->name }}"
                                                    {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @foreach ($permissions as $category => $perms)
                        @if (!$category)
                            <div class="mb-3">
                                <div class="row g-2">
                                    @foreach ($perms as $permission)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-check">
                                                <input class="form-check-input permission-checkbox" type="checkbox"
                                                    name="permissions[]" id="permission-{{ $permission->id }}"
                                                    value="{{ $permission->name }}"
                                                    {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-muted">No permissions available. <a
                            href="{{ route('admin.permissions.create') }}">Create a permission first</a>.</p>
                @endif
            </div>
        </div>

        <!-- Currently Assigned (read-only) -->
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="icon-base ti tabler-list me-2"></i>Current Permissions Overview
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-2">Roles</h6>
                        @if ($user->roles->count() > 0)
                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-label-success">{{ $role->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No roles assigned</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-2">Direct Permissions</h6>
                        @if ($user->permissions->count() > 0)
                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($user->permissions as $permission)
                                    <span class="badge bg-label-warning">{{ $permission->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No direct permissions assigned</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Users
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="icon-base ti tabler-save me-1"></i> Save Changes
            </button>
        </div>
        </form>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all-permissions-user');
            const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    permissionCheckboxes.forEach(cb => cb.checked = this.checked);
                });

                permissionCheckboxes.forEach(cb => {
                    cb.addEventListener('change', function() {
                        const allChecked = Array.from(permissionCheckboxes).every(box => box
                            .checked);
                        selectAllCheckbox.checked = allChecked;
                    });
                });
            }
        });
    </script>
@endpush
