@extends('admin.layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Category Information</h4>
                </div>
                <div class="card-body text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                            <i class="icon-base ti tabler-tag"></i>
                        </span>
                    </div>
                    <h5>{{ $category->name }}</h5>
                    <p class="text-muted mb-3">{{ $category->slug }}</p>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td style="width: 120px;"><strong>Status</strong></td>
                                <td>
                                    @if($category->is_active)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Products</strong></td>
                                <td>{{ $category->products_count }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $category->created_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit Form Column -->
        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')

                <!-- Category Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-tag me-2"></i>Edit Category
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Update the category details below</p>

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-12">
                                <label for="name" class="form-label">Category Name <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $category->name) }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-md-12">
                                <label class="form-label">Slug <span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <code class="me-3 fs-6">{{ $category->slug }}</code>
                                </div>
                                <div class="form-text">Slugs are generated automatically from the name and cannot be changed manually.</div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                    name="description"
                                    rows="3">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="is_active" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('is_active') is-invalid @enderror"
                                    id="is_active"
                                    name="is_active"
                                    required>
                                    <option value="1"
                                        {{ old('is_active', $category->is_active) == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0"
                                        {{ old('is_active', $category->is_active) == '0' ? 'selected' : '' }}>
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

                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Categories
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
