@extends('admin.layouts.admin')

@section('title', 'Permissions Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Permissions</h4>
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-1"></i> Add Permission
            </a>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.permissions.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search permissions..."
                                value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-search"></i>
                            </button>
                        </div>
                        @if ($search)
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @if ($permissions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Guard</th>
                                <th>Roles Count</th>
                                <th>Created At</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $permission->name }}</span>
                                    </td>
                                    <td>
                                        @if ($permission->category)
                                            <span class="badge bg-label-secondary">{{ $permission->category }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-label-secondary">{{ $permission->guard_name }}</span></td>
                                    <td>
                                        <span class="badge bg-label-success">{{ $permission->roles->count() }} roles</span>
                                    </td>
                                    <td>{{ $permission->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.permissions.show', $permission) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $permission->id }}"
                                                title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $permission->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form method="POST"
                                                    action="{{ route('admin.permissions.destroy', $permission) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete the permission
                                                                "<strong>{{ $permission->name }}</strong>"?</p>
                                                            <p class="text-danger small">
                                                                <i class="icon-base ti tabler-alert-triangle"></i>
                                                                This action cannot be undone. Roles with this permission
                                                                will lose it.
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete
                                                                Permission</button>
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

                <div class="mt-3">
                    {{ $permissions->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-key text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No permissions found</h5>
                    <p class="text-muted">Get started by creating a new permission.</p>
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Create Permission
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
