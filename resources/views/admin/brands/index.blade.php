@extends('admin.layouts.admin')

@section('title', 'Brands Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Brands</h4>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-1"></i> Add Brand
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.brands.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search brands..."
                                value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-search"></i>
                            </button>
                        </div>
                        @if ($search)
                            <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @if ($brands->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Website</th>
                                <th>Status</th>
                                <th>Products</th>
                                <th>Created At</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td><span class="fw-semibold">{{ $brand->name }}</span></td>
                                    <td><code>{{ $brand->slug }}</code></td>
                                    <td>{{ $brand->website ?: '—' }}</td>
                                    <td><x-admin.status-badge :active="$brand->is_active" /></td>
                                    <td><span class="badge bg-label-info">{{ $brand->products_count }}</span></td>
                                    <td>{{ $brand->created_at->format(config('admin.date_format')) }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.brands.show', $brand) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.brands.edit', $brand) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-delete-name="{{ $brand->name }}"
                                                data-delete-url="{{ route('admin.brands.destroy', $brand) }}"
                                                title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-2 px-3 border-top-0">
                    {{ $brands->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-barcode text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No brands found</h5>
                    <p class="text-muted">Get started by creating a new brand.</p>
                    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Add Brand
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('admin.partials.delete-modal')
@endsection
