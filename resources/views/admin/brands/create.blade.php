@extends('admin.layouts.admin')

@section('title', 'Add Brand')

@section('content')
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">New Brand</h4>
                </div>
                <div class="card-body text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial bg-label-success rounded-circle" style="font-size: 2.5rem;">
                            <i class="icon-base ti tabler-barcode"></i>
                        </span>
                    </div>
                    <h5>Fill in the details</h5>
                    <p class="text-muted mb-3">Complete the form below to add a new brand (Lenovo, Dell, HP, Apple, etc.).</p>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Brands
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
                @csrf

                @include('admin.brands.form', ['brand' => null])

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Brands
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-save me-1"></i> Create Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
