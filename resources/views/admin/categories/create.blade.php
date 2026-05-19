@extends('admin.layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">New Category</h4>
                </div>
                <div class="card-body text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial bg-label-success rounded-circle" style="font-size: 2.5rem;">
                            <i class="icon-base ti tabler-tag"></i>
                        </span>
                    </div>
                    <h5>Fill in the details</h5>
                    <p class="text-muted mb-3">Complete the form below to add a new product category.</p>

                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Create Form Column -->
        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <!-- Category Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-tag me-2"></i>Category Information
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Enter the category details below</p>

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-12">
                                <label for="name" class="form-label">Category Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-md-12">
                                <label class="form-label">Slug <span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <code class="me-3 fs-6">Auto-generated from name</code>
                                </div>
                                <div class="form-text">The slug is generated automatically from the category name.</div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                    name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="is_active" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('is_active') is-invalid @enderror"
                                    id="is_active" name="is_active" required>
                                    <option value="1" {{ old('is_active', '1') === '1' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
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
                        <i class="icon-base ti tabler-save me-1"></i> Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
