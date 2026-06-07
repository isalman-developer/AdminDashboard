@extends('admin.layouts.admin')

@section('title', 'Edit Brand')

@section('content')
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Brand Information</h4>
                </div>
                <div class="card-body text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                            <i class="icon-base ti tabler-barcode"></i>
                        </span>
                    </div>
                    <h5>{{ $brand->name }}</h5>
                    <p class="text-muted mb-3">{{ $brand->slug }}</p>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td style="width: 120px;"><strong>Status</strong></td>
                                <td><x-admin.status-badge :active="$brand->is_active" /></td>
                            </tr>
                            <tr>
                                <td><strong>Products</strong></td>
                                <td>{{ $brand->products_count }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $brand->created_at->format(config('admin.date_format')) }}</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Brands
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.brands.form', ['brand' => $brand])

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Brands
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
