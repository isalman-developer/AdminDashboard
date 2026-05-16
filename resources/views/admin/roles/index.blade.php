@extends('admin.layouts.admin')

@section('title', 'Roles Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Roles</h4>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-1"></i> Add Role
            </a>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.roles.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search roles..."
                                value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-search"></i>
                            </button>
                        </div>
                        @if ($search)
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @if ($roles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Guard</th>
                                <th>Permissions Count</th>
                                <th>Created At</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $role->name }}</span>
                                    </td>
                                    <td><span class="badge bg-label-secondary">{{ $role->guard_name }}</span></td>
                                    <td>
                                        <span class="badge bg-label-info">{{ $role->permissions->count() }}
                                            permissions</span>
                                    </td>
                                    <td>{{ $role->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.roles.show', $role) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.roles.edit', $role) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}"
                                                title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete the role
                                                                "<strong>{{ $role->name }}</strong>"?</p>
                                                            <p class="text-danger small">
                                                                <i class="icon-base ti tabler-alert-triangle"></i>
                                                                This action cannot be undone. Users assigned to this role
                                                                will lose these permissions.
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete
                                                                Role</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-2 px-3 border-top-0">
            {{ $roles->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-shield-off text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No roles found</h5>
                    <p class="text-muted">Get started by creating a new role.</p>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Create Role
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
