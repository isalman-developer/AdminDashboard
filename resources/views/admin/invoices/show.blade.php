@extends('admin.layouts.admin')

@section('title', $invoice->invoice_number)

@section('content')

@php
    $statusColors = [
        'draft'     => 'secondary',
        'sent'      => 'info',
        'paid'      => 'success',
        'partial'   => 'warning',
        'overdue'   => 'danger',
        'cancelled' => 'secondary',
    ];
    $discAmt  = $invoice->subtotal * ($invoice->discount / 100);
    $taxAmt   = ($invoice->subtotal - $discAmt) * ($invoice->tax / 100);
@endphp

<div class="row g-4">

    {{-- ── Invoice preview (col-xl-9) ─────────────────────────────────────── --}}
    <div class="col-xl-9">
        <div class="card p-sm-4 p-2">
            <div class="card-body">

                {{-- Header --}}
                <div class="row mb-5">
                    <div class="col-sm-6 mb-4 mb-sm-0">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="avatar bg-label-primary rounded">
                                <i class="icon-base ti tabler-file-invoice" style="font-size:1.5rem;"></i>
                            </span>
                            <h4 class="fw-bold mb-0">Your Company</h4>
                        </div>
                        <p class="mb-1 text-muted small">Office 149, 450 South Brand Brooklyn</p>
                        <p class="mb-1 text-muted small">San Diego County, CA 91905, USA</p>
                        <p class="mb-0 text-muted small">+1 (123) 456 7891</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end">
                            <h3 class="fw-bold text-primary mb-1">INVOICE</h3>
                            <p class="fw-semibold mb-2 fs-5">{{ $invoice->invoice_number }}</p>
                            <table class="ms-auto" style="border-spacing:4px 2px;">
                                <tr>
                                    <td class="text-muted small pe-3">Date Issued:</td>
                                    <td class="fw-semibold small">{{ $invoice->issue_date->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small pe-3">Due Date:</td>
                                    <td class="fw-semibold small">{{ $invoice->due_date->format('M d, Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                {{-- Invoice To --}}
                <div class="row mb-5 mt-4">
                    <div class="col-sm-6">
                        <h6 class="fw-semibold text-muted text-uppercase mb-3" style="font-size:.75rem;letter-spacing:.08em;">Invoice To</h6>
                        <p class="fw-semibold mb-1">{{ $invoice->client_name }}</p>
                        @if($invoice->client_company)
                            <p class="mb-1 text-muted small">{{ $invoice->client_company }}</p>
                        @endif
                        @if($invoice->client_address)
                            <p class="mb-1 text-muted small">{{ $invoice->client_address }}</p>
                        @endif
                        <p class="mb-1 text-muted small">{{ $invoice->client_email }}</p>
                        @if($invoice->client_phone)
                            <p class="mb-0 text-muted small">{{ $invoice->client_phone }}</p>
                        @endif
                    </div>
                </div>

                {{-- Items table --}}
                <div class="table-responsive mb-4">
                    <table class="table table-borderless">
                        <thead class="border-top border-bottom">
                            <tr>
                                <th class="ps-0">Item</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end pe-0">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->order->items as $item)
                                <tr>
                                    <td class="ps-0 fw-semibold">{{ $item->product_name }}</td>
                                    <td class="text-end">${{ number_format($item->product_price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end pe-0">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                            @if ($invoice->order->shipping > 0)
                                <tr class="text-muted">
                                    <td class="ps-0">Shipping</td>
                                    <td class="text-end">${{ number_format($invoice->order->shipping, 2) }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-end pe-0">${{ number_format($invoice->order->shipping, 2) }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- Totals --}}
                <div class="row">
                    <div class="col-sm-7">
                        @if ($invoice->note)
                            <div class="p-3 bg-light rounded">
                                <p class="fw-semibold mb-1 small">Note:</p>
                                <p class="text-muted small mb-0">{{ $invoice->note }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-5">
                        <table class="w-100">
                            <tr>
                                <td class="text-muted small pb-2">Subtotal:</td>
                                <td class="text-end fw-semibold small pb-2">${{ number_format($invoice->subtotal, 2) }}</td>
                            </tr>
                            @if ($invoice->discount > 0)
                                <tr>
                                    <td class="text-muted small pb-2">Discount ({{ $invoice->discount }}%):</td>
                                    <td class="text-end text-danger small pb-2">-${{ number_format($discAmt, 2) }}</td>
                                </tr>
                            @endif
                            @if ($invoice->tax > 0)
                                <tr>
                                    <td class="text-muted small pb-2">Tax ({{ $invoice->tax }}%):</td>
                                    <td class="text-end small pb-2">${{ number_format($taxAmt, 2) }}</td>
                                </tr>
                            @endif
                            <tr class="border-top">
                                <td class="fw-bold pt-2">Total:</td>
                                <td class="text-end fw-bold pt-2 fs-5">${{ number_format($invoice->total, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── Actions sidebar (col-xl-3) ──────────────────────────────────────── --}}
    <div class="col-xl-3">

        {{-- Actions card --}}
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('admin.invoices.edit', $invoice) }}" class="btn btn-primary w-100 mb-2">
                    <i class="icon-base ti tabler-edit me-1"></i> Edit Invoice
                </a>

                @if (!in_array($invoice->status, ['paid','cancelled']))
                    <form method="POST" action="{{ route('admin.invoices.markPaid', $invoice) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-success w-100 mb-2">
                            <i class="icon-base ti tabler-circle-check me-1"></i> Mark as Paid
                        </button>
                    </form>
                @endif

                <button type="button" class="btn btn-outline-danger w-100"
                    data-delete-name="{{ $invoice->invoice_number }}"
                    data-delete-url="{{ route('admin.invoices.destroy', $invoice) }}">
                    <i class="icon-base ti tabler-trash me-1"></i> Delete Invoice
                </button>
            </div>
        </div>

        {{-- Status & dates card --}}
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-semibold">Status</span>
                    <span class="badge bg-label-{{ $statusColors[$invoice->status] ?? 'secondary' }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>
                <hr>
                <div class="mb-2">
                    <small class="text-muted d-block">Issue Date</small>
                    <span class="fw-semibold">{{ $invoice->issue_date->format('M d, Y') }}</span>
                </div>
                <div>
                    <small class="text-muted d-block">Due Date</small>
                    <span class="fw-semibold {{ $invoice->status === 'overdue' ? 'text-danger' : '' }}">
                        {{ $invoice->due_date->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Linked order --}}
        @if ($invoice->order)
            <div class="card mt-4">
                <div class="card-body">
                    <small class="text-muted d-block mb-1">Linked Order</small>
                    <a href="{{ route('admin.orders.show', $invoice->order) }}"
                        class="fw-semibold text-body d-flex align-items-center gap-1">
                        <i class="icon-base ti tabler-clipboard-list"></i>
                        {{ $invoice->order->order_number }}
                    </a>
                    <div class="small text-muted mt-1">{{ ucfirst($invoice->order->order_status) }}</div>
                </div>
            </div>
        @endif

        {{-- Back link --}}
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-secondary w-100 mt-3">
            <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Invoices
        </a>

    </div>
</div>

@include('admin.partials.delete-modal')

@endsection
