{{-- $category is null on create, Category model on edit --}}

<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title mb-0">
            <i class="icon-base ti tabler-tag me-2"></i>{{ $category ? 'Edit Category' : 'Category Information' }}
        </h4>
    </div>
    <div class="card-body">
        <p class="text-muted small mb-3">
            {{ $category ? 'Update the category details below' : 'Enter the category details below' }}
        </p>

        <div class="row g-3">
            <div class="col-md-12">
                <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name"
                    value="{{ old('name', $category?->name) }}"
                    required {{ $category ? '' : 'autofocus' }}>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Slug <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center">
                    <code class="me-3 fs-6">{{ $category ? $category->slug : 'Auto-generated from name' }}</code>
                </div>
                <div class="form-text">
                    {{ $category
                        ? 'Slugs are generated automatically from the name and cannot be changed manually.'
                        : 'The slug is generated automatically from the category name.' }}
                </div>
            </div>

            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description" rows="3">{{ old('description', $category?->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('is_active') is-invalid @enderror"
                    id="is_active" name="is_active" required>
                    <option value="1"
                        {{ old('is_active', $category ? (int) $category->is_active : 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0"
                        {{ old('is_active', $category ? (int) $category->is_active : 1) == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
