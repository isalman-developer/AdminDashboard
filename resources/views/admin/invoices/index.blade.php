@extends('admin.layouts.admin')

@section('title', 'Invoices')

@section('content')

    {{-- Stat cards --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-secondary">
                            <i class="icon-base ti tabler-files"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total Invoices</small>
                        <h4 class="mb-0">{{ $stats['total'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="icon-base ti tabler-circle-check"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Paid</small>
                        <h4 class="mb-0">{{ $stats['paid'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="icon-base ti tabler-clock"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Unpaid</small>
                        <h4 class="mb-0">{{ $stats['unpaid'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="icon-base ti tabler-alert-circle"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Overdue</small>
                        <h4 class="mb-0">{{ $stats['overdue'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Invoices</h4>
        </div>
        <div class="card-body">

            {{-- Search / filter --}}
            <div class="row mb-4">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('admin.invoices.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Invoice # or client name / email"
                                value="{{ request('search') }}">
                            <select name="status" class="form-select" style="max-width:160px;">
                                <option value="">All Statuses</option>
                                @foreach(['draft','sent','paid','partial','overdue','cancelled'] as $s)
                                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-filter"></i> Filter
                            </button>
                        </div>
                        @if(request('search') || request('status'))
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @php
                $statusColors = [
                    'draft'     => 'secondary',
                    'sent'      => 'info',
                    'paid'      => 'success',
                    'partial'   => 'warning',
                    'overdue'   => 'danger',
                    'cancelled' => 'secondary',
                ];
            @endphp

            @if ($invoices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Client</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th style="width:130px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration + ($invoices->currentPage() - 1) * $invoices->perPage() }}</td>
                                    <td>
                                        <a href="{{ route('admin.invoices.show', $invoice) }}" class="fw-semibold text-body">
                                            {{ $invoice->invoice_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ $invoice->client_name }}</span>
                                        @if($invoice->client_company)
                                            <div class="small text-muted">{{ $invoice->client_company }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $invoice->issue_date->format('M d, Y') }}</td>
                                    <td>{{ $invoice->due_date->format('M d, Y') }}</td>
                                    <td class="fw-semibold">${{ number_format($invoice->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $statusColors[$invoice->status] ?? 'secondary' }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.invoices.show', $invoice) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary"
                                                data-bs-toggle="tooltip" title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.invoices.edit', $invoice) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-delete-name="{{ $invoice->invoice_number }}"
                                                data-delete-url="{{ route('admin.invoices.destroy', $invoice) }}"
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
                    {{ $invoices->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-file-invoice text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No invoices found</h5>
                </div>
            @endif

        </div>
    </div>

    @include('admin.partials.delete-modal')

@endsection
