@extends('admin.layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Users</h4>
        </div>
        <div class="card-body">
            <!-- Search and Filters -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search users..."
                                value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="icon-base ti tabler-plus me-1"></i> Add User
                        </a>
                        @if ($search)
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x me-1"></i> Clear
                            </a>
                        @endif
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <i class="icon-base ti tabler-filter me-1"></i> Filter by Role
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ !$roleFilter ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', array_merge(request()->except('role'), ['role' => null])) }}">All
                                        Roles</a></li>
                                @foreach ($roles as $role)
                                    <li><a class="dropdown-item {{ $roleFilter === $role->name ? 'active' : '' }}"
                                            href="{{ route('admin.users.index', array_merge(request()->except('role'), ['role' => $role->name])) }}">{{ $role->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <i class="icon-base ti tabler-filter me-1"></i> Filter by Status
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ !$statusFilter ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => null])) }}">All
                                        Statuses</a></li>
                                <li><a class="dropdown-item {{ $statusFilter === 'active' ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'active'])) }}">Active</a>
                                </li>
                                <li><a class="dropdown-item {{ $statusFilter === 'inactive' ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'inactive'])) }}">Inactive</a>
                                </li>
                                <li><a class="dropdown-item {{ $statusFilter === 'blocked' ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'blocked'])) }}">Blocked</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if ($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Roles</th>
                                <th>Joined</th>
                                <th style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-circle me-2">
                                                <span class="avatar-initial bg-label-primary rounded-circle">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <span class="fw-semibold">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->status === 'active')
                                            <span class="badge bg-label-success">Active</span>
                                        @elseif($user->status === 'inactive')
                                            <span class="badge bg-label-secondary">Inactive</span>
                                        @elseif($user->status === 'blocked')
                                            <span class="badge bg-label-danger">Blocked</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->roles->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach ($user->roles as $role)
                                                    <span class="badge bg-label-info">{{ $role->name }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted">No roles</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit User">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit-roles', $user) }}"
                                                class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip"
                                                title="Manage Roles">
                                                <i class="icon-base ti tabler-user-cog"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#viewModal-{{ $user->id }}"
                                                title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </button>
                                        </div>

                                        <!-- View User Modal -->
                                        <div class="modal fade" id="viewModal-{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">User Details</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center mb-3">
                                                            <div class="avatar avatar-lg mx-auto mb-2">
                                                                <span class="avatar-initial bg-label-primary rounded-circle"
                                                                    style="font-size: 2rem;">
                                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                                </span>
                                                            </div>
                                                            <h5>{{ $user->name }}</h5>
                                                            <p class="text-muted">{{ $user->email }}</p>
                                                        </div>
                                                        <table class="table table-sm table-borderless">
                                                            <tr>
                                                                <td><strong>Username</strong></td>
                                                                <td>{{ $user->username }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Status</strong></td>
                                                                <td>
                                                                    @if ($user->status === 'active')
                                                                        <span class="badge bg-label-success">Active</span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-label-secondary">{{ ucfirst($user->status) }}</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Joined</strong></td>
                                                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Roles</strong></td>
                                                                <td>
                                                                    @if ($user->roles->count() > 0)
                                                                        @foreach ($user->roles as $role)
                                                                            <span
                                                                                class="badge bg-label-info">{{ $role->name }}</span>
                                                                        @endforeach
                                                                    @else
                                                                        <span class="text-muted">No roles</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('admin.users.edit-roles', $user) }}"
                                                            class="btn btn-primary">
                                                            <i class="icon-base ti tabler-user-cog me-1"></i> Manage Roles
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

<div class="card-footer py-2 px-3 border-top-0">
            {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-users text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No users found</h5>
                    <p class="text-muted">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-refresh me-1"></i> Reset Filters
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
