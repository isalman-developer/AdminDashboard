@extends('admin.layouts.admin')

@section('title', 'My Profile')
@section('description', 'View and manage your profile details')

@section('content')
    <!-- Profile Header -->
    <div class="row mb-6">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-4">
                        <div class="avatar avatar-xl me-2">
                            <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="mb-1">{{ $user->name }}</h3>
                            <p class="text-muted mb-2">{{ $user->email }}</p>
                            @if ($user->roles->count() > 0)
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-label-info">{{ $role->name }}</span>
                                    @endforeach
                                </div>
                            @else
                                <span class="badge bg-label-secondary">No roles assigned</span>
                            @endif
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-primary mt-3">
                                <i class="icon-base ti tabler-edit me-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="row">
        <!-- Personal Information -->
        <div class="col-md-6 mb-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Personal Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td style="width: 40%;"><strong>Full Name</strong></td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td>{{ $user->username ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $user->email }}</td>
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
                            <td><strong>Joined</strong></td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Updated</strong></td>
                            <td>{{ $user->updated_at->format('M d, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Roles & Permissions -->
        <div class="col-md-6 mb-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Roles & Permissions</h5>
                </div>
                <div class="card-body">
                    @if ($user->roles->count() > 0)
                        <h6 class="text-muted small fw-bold mb-2 text-uppercase">Assigned Roles</h6>
                        @foreach ($user->roles as $role)
                            <span class="badge bg-label-info me-1 mb-1">{{ $role->name }}</span>
                        @endforeach

                        @if ($user->roles->first()->permissions->count() > 0)
                            <hr class="my-4">
                            <h6 class="text-muted small fw-bold mb-2 text-uppercase">Permissions</h6>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($user->roles as $role)
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge bg-label-primary me-1 mb-1">{{ $permission->name }}</span>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="icon-base ti tabler-shield-off text-muted" style="font-size: 2.5rem;"></i>
                            <p class="text-muted mt-2 mb-0">No roles assigned</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Direct Reports -->
    @if ($user->children->count() > 0)
        <div class="row">
            <div class="col-12 mb-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Direct Reports</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->children as $child)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-circle me-2">
                                                        <span class="avatar-initial bg-label-primary rounded-circle">
                                                            {{ strtoupper(substr($child->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                    <span class="fw-semibold">{{ $child->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $child->email }}</td>
                                            <td>
                                                @if ($child->status === 'active')
                                                    <span class="badge bg-label-success">Active</span>
                                                @elseif($child->status === 'inactive')
                                                    <span class="badge bg-label-secondary">Inactive</span>
                                                @else
                                                    <span class="badge bg-label-warning">{{ ucfirst($child->status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $child->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Referrer Info -->
    @if ($user->parent)
        <div class="row">
            <div class="col-12 mb-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Referred By</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-circle me-2">
                                <span class="avatar-initial bg-label-primary rounded-circle">
                                    {{ strtoupper(substr($user->parent->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <span class="fw-semibold">{{ $user->parent->name }}</span>
                                <br>
                                <span class="text-muted small">{{ $user->parent->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
