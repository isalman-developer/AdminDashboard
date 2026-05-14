<div class="mb-3">
    <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name ?? '') }}"
        required>
    <small class="text-muted">Use a unique name for this role (e.g., "editor", "moderator")</small>
</div>

<div class="mb-4">
    <label class="form-label">Permissions</label>
    <div class="mb-2">
        <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="select-all-permissions">
            <label class="form-check-label" for="select-all-permissions">
                <strong>Select All</strong>
            </label>
        </div>
    </div>

    @if ($permissions->count() > 0)
        @foreach ($permissions as $category => $perms)
            @if ($category)
                <div class="mb-3">
                    <h6 class="text-uppercase text-muted small fw-bold mb-2">{{ $category }}</h6>
                    <div class="row g-2">
                        @foreach ($perms as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input permission-checkbox" type="checkbox"
                                        name="permissions[]" id="permission-{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                        {{ (isset($rolePermissions) && in_array($permission->id, $rolePermissions)) || old('permissions.*') == $permission->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="row g-2">
                    @foreach ($perms as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                                    id="permission-{{ $permission->id }}" value="{{ $permission->id }}"
                                    {{ (isset($rolePermissions) && in_array($permission->id, $rolePermissions)) || old('permissions.*') == $permission->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    @else
        <div class="alert alert-warning">
            <i class="icon-base ti tabler-alert-circle me-2"></i>
            No permissions available. <a href="{{ route('admin.permissions.create') }}">Create a permission first</a>.
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all-permissions');
        const checkboxes = document.querySelectorAll('.permission-checkbox');

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });

            // Update select-all state when individual checkboxes change
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const allChecked = Array.from(checkboxes).every(box => box.checked);
                    selectAll.checked = allChecked;
                });
            });
        }
    });
</script>
