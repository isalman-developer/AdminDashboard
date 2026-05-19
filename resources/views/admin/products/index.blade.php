@extends('admin.layouts.admin')

@section('title', 'Products Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Products</h4>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-1"></i> Add Product
            </a>
        </div>
        <div class="card-body">
            <!-- Search & Filter Form -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search products..."
                                value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-search"></i>
                            </button>
                        </div>
                        @if ($search || $categoryId)
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="{{ route('admin.products.index') }}">
                        <div class="input-group">
                            <select name="category_id" class="form-select"
                                onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $categoryId == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($search)
                                <input type="hidden" name="search" value="{{ $search }}">
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            @if ($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>BV / PV</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th style="width: 160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $product->name }}</span>
                                        @if ($product->image_path)
                                            <br><small class="text-muted">
                                                <i class="icon-base ti tabler-image"></i> Has image
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $product->category?->name ?: '—' }}
                                    </td>
                                    <td><code>{{ $product->sku ?: '—' }}</code></td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->bv }} / {{ $product->pv }}</td>
                                    <td>
                                        {{ $product->stock_quantity }}
                                        @if ($product->stock_quantity < 10)
                                            <span class="badge bg-label-warning ms-1">Low</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->is_active)
                                            <span class="badge bg-label-success">Active</span>
                                        @else
                                            <span class="badge bg-label-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.products.show', $product) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button"
                                                class="btn btn-sm btn-icon {{ $product->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                data-bs-toggle="tooltip"
                                                title="{{ $product->is_active ? 'Deactivate' : 'Activate' }}"
                                                onclick="toggleProductStatus({{ $product->id }}, this)">
                                                <i class="icon-base ti {{ $product->is_active ? 'tabler-pause' : 'tabler-play' }}"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}"
                                                title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form method="POST"
                                                    action="{{ route('admin.products.destroy', $product) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete the product
                                                                "<strong>{{ $product->name }}</strong>"?</p>
                                                            <p class="text-danger small">
                                                                <i class="icon-base ti tabler-alert-triangle"></i>
                                                                This action cannot be undone.
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">Delete Product</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-2 px-3 border-top-0">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-package text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No products found</h5>
                    <p class="text-muted">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary me-2">
                        <i class="icon-base ti tabler-refresh me-1"></i> Reset Filters
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Add Product
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        async function toggleProductStatus(productId, button) {
            const isActive = button.classList.contains('btn-outline-warning');
            try {
                const response = await fetch(`/admin/products/${productId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const data = await response.json();
                if (data.success) {
                    button.classList.toggle('btn-outline-warning', data.is_active);
                    button.classList.toggle('btn-outline-success', !data.is_active);
                    const icon = button.querySelector('i');
                    icon.className = 'icon-base ti ' + (data.is_active ? 'tabler-pause' : 'tabler-play');
                    button.setAttribute('title', data.is_active ? 'Deactivate' : 'Activate');
                    // Update the status badge in the row
                    const row = button.closest('tr');
                    const badge = row.querySelector('.bg-label-success, .bg-label-secondary');
                    if (badge) {
                        badge.className = data.is_active ? 'badge bg-label-success' : 'badge bg-label-secondary';
                        badge.textContent = data.is_active ? 'Active' : 'Inactive';
                    }
                } else {
                    alert(data.message || 'Unable to toggle product status.');
                }
            } catch (e) {
                alert('Network error. Please try again.');
            }
        }
    </script>
@endpush
