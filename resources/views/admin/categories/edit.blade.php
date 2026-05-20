@extends('admin.layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="row">
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
                                <td><x-admin.status-badge :active="$category->is_active" /></td>
                            </tr>
                            <tr>
                                <td><strong>Products</strong></td>
                                <td>{{ $category->products_count }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $category->created_at->format(config('admin.date_format')) }}</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Categories
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')

                @include('admin.categoriesform', ['category' => $category])

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
