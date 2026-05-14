@extends('admin.layouts.admin')

@section('title', 'Permission Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Permission: {{ $permission->name }}</h4>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary">
                    <i class="icon-base ti tabler-edit me-1"></i> Edit Permission
                </a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="icon-base ti tabler-trash me-1"></i> Delete
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 150px;"><strong>Permission Name</strong></td>
                            <td>{{ $permission->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Category</strong></td>
                            <td>
                                @if($permission->category)
                                    <span class="badge bg-label-secondary">{{ $permission->category }}</span>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Guard Name</strong></td>
                            <td><span class="badge bg-label-secondary">{{ $permission->guard_name }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>{{ $permission->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{ $permission->updated_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Assigned Roles ({{ $roles->count() }})</h5>
                    @if($roles->count() > 0)
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($roles as $role)
                                <a href="{{ route('admin.roles.show', $role) }}" class="badge bg-label-primary text-decoration-none">
                                    {{ $role->name }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No roles have this permission.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the permission "<strong>{{ $permission->name }}</strong>"?</p>
                        <p class="text-danger small">
                            <i class="icon-base ti tabler-alert-triangle"></i>
                            This action cannot be undone. Roles with this permission will lose it.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Permission</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
