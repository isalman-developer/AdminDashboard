@extends('admin.layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="row">
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

        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                @include('admin.categories.form', ['category' => null])

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
