@extends('admin.layouts.admin')

@section('title', 'Role Details')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Role: {{ $role->name }}</h4>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary">
                    <i class="icon-base ti tabler-edit me-1"></i> Edit Role
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
                            <td style="width: 150px;"><strong>Role Name</strong></td>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Guard Name</strong></td>
                            <td><span class="badge bg-label-secondary">{{ $role->guard_name }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>{{ $role->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{ $role->updated_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Assigned Permissions ({{ $role->permissions->count() }})</h5>
                    @if($role->permissions->count() > 0)
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($role->permissions as $permission)
                                <span class="badge bg-label-info">
                                    {{ $permission->name }}
                                    @if($permission->category)
                                        <small class="text-muted">({{ $permission->category }})</small>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No permissions assigned to this role.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the role "<strong>{{ $role->name }}</strong>"?</p>
                        <p class="text-danger small">
                            <i class="icon-base ti tabler-alert-triangle"></i>
                            This action cannot be undone. Users with this role will lose those permissions.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
