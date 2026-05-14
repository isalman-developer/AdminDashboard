<div class="mb-3">
    <label for="name" class="form-label">Permission Name <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name" class="form-control" 
           value="{{ old('name', $permission->name ?? '') }}" required>
    <small class="text-muted">Use snake_case format (e.g., "create_users", "edit_posts")</small>
</div>

<div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <input type="text" name="category" id="category" class="form-control" 
           value="{{ old('category', $permission->category ?? '') }}" 
           placeholder="e.g., User Management, Posts, Settings">
    <small class="text-muted">Optional: Group permissions by category for better organization</small>
</div>
