@extends('admin.layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Product Information</h4>
                </div>
                <div class="card-body text-center">
                    @if ($product->image)
                        <div class="avatar avatar-lg mx-auto mb-3 border rounded-circle p-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                    @else
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                                <i class="icon-base ti tabler-package"></i>
                            </span>
                        </div>
                    @endif
                    <h5>{{ $product->name }}</h5>
                    <p class="text-muted mb-2">{{ $product->category?->name ?: 'Uncategorized' }}</p>
                    <div class="mb-3">
                        <x-admin.status-badge :active="$product->is_active" />
                    </div>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td style="width: 100px;"><strong>SKU</strong></td>
                                <td><code>{{ $product->sku ?: '—' }}</code></td>
                            </tr>
                            <tr>
                                <td><strong>Price</strong></td>
                                <td>{{ config('admin.currency_symbol') }}{{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>BV / PV</strong></td>
                                <td>{{ $product->bv }} / {{ $product->pv }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stock</strong></td>
                                <td>{{ $product->stock_quantity }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $product->created_at->format(config('admin.date_format')) }}</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.products.form', ['product' => $product])

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Products
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
