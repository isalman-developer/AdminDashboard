{{-- Edit-only form (invoices are generated from orders, not created manually) --}}

<div class="row g-4">

    {{-- ── Main form column (col-lg-9) ─────────────────────────────────────── --}}
    <div class="col-lg-9">

        {{-- Invoice header card --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-start">
                    {{-- Company info (static) --}}
                    <div class="col-sm-6 mb-4 mb-sm-0">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="avatar bg-label-primary rounded">
                                <i class="icon-base ti tabler-file-invoice" style="font-size:1.25rem;"></i>
                            </span>
                            <h5 class="fw-bold mb-0">Your Company</h5>
                        </div>
                        <p class="text-muted small mb-0">Office 149, 450 South Brand Brooklyn<br>San Diego County, CA 91905, USA</p>
                    </div>

                    {{-- Invoice meta --}}
                    <div class="col-sm-6">
                        <div class="row g-2">
                            <div class="col-12">
                                <label class="form-label small text-muted">Invoice #</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $invoiceNumber }}" disabled>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted" for="issue_date">
                                    Issue Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" id="issue_date" name="issue_date"
                                    class="form-control form-control-sm @error('issue_date') is-invalid @enderror"
                                    value="{{ old('issue_date', $invoice->issue_date->format('Y-m-d')) }}" required>
                                @error('issue_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted" for="due_date">
                                    Due Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" id="due_date" name="due_date"
                                    class="form-control form-control-sm @error('due_date') is-invalid @enderror"
                                    value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" required>
                                @error('due_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Client information --}}
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="icon-base ti tabler-user me-2 text-muted"></i>Client Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="client_name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" id="client_name" name="client_name"
                            class="form-control @error('client_name') is-invalid @enderror"
                            value="{{ old('client_name', $invoice->client_name) }}" required>
                        @error('client_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="client_company">Company</label>
                        <input type="text" id="client_company" name="client_company"
                            class="form-control @error('client_company') is-invalid @enderror"
                            value="{{ old('client_company', $invoice->client_company) }}">
                        @error('client_company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="client_email">Email <span class="text-danger">*</span></label>
                        <input type="email" id="client_email" name="client_email"
                            class="form-control @error('client_email') is-invalid @enderror"
                            value="{{ old('client_email', $invoice->client_email) }}" required>
                        @error('client_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="client_phone">Phone</label>
                        <input type="text" id="client_phone" name="client_phone"
                            class="form-control @error('client_phone') is-invalid @enderror"
                            value="{{ old('client_phone', $invoice->client_phone) }}">
                        @error('client_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="client_address">Address</label>
                        <input type="text" id="client_address" name="client_address"
                            class="form-control @error('client_address') is-invalid @enderror"
                            value="{{ old('client_address', $invoice->client_address) }}">
                        @error('client_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Order items (read-only) --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    <i class="icon-base ti tabler-list-details me-2 text-muted"></i>Order Items
                </h6>
                @if ($invoice->order)
                    <a href="{{ route('admin.orders.show', $invoice->order) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="icon-base ti tabler-clipboard-list me-1"></i>{{ $invoice->order->order_number }}
                    </a>
                @endif
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="border-bottom">
                            <tr>
                                <th class="ps-4">Item</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->order->items as $item)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $item->product_name }}</td>
                                    <td class="text-end">${{ number_format($item->product_price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end pe-4">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                            @if ($invoice->order->shipping > 0)
                                <tr class="text-muted">
                                    <td class="ps-4">Shipping</td>
                                    <td class="text-end">${{ number_format($invoice->order->shipping, 2) }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-end pe-4">${{ number_format($invoice->order->shipping, 2) }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Totals summary with editable discount / tax --}}
            <div class="card-footer">
                <div class="row justify-content-end">
                    <div class="col-sm-6 col-md-4"
                        data-subtotal="{{ $invoice->subtotal }}">
                        <table class="w-100">
                            <tr>
                                <td class="text-muted small pb-2">Subtotal:</td>
                                <td class="text-end fw-semibold small pb-2" id="display-subtotal">
                                    ${{ number_format($invoice->subtotal, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted small pb-2">
                                    Discount
                                    (<input type="number" name="discount" id="discount-pct"
                                        class="d-inline-block form-control form-control-sm p-0 text-center border-0 border-bottom rounded-0"
                                        style="width:42px;"
                                        min="0" max="100" step="0.01"
                                        value="{{ old('discount', $invoice->discount) }}" oninput="recalc()">%):
                                </td>
                                <td class="text-end text-danger small pb-2" id="display-discount">
                                    -${{ number_format($invoice->subtotal * ($invoice->discount / 100), 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted small pb-2">
                                    Tax
                                    (<input type="number" name="tax" id="tax-pct"
                                        class="d-inline-block form-control form-control-sm p-0 text-center border-0 border-bottom rounded-0"
                                        style="width:42px;"
                                        min="0" max="100" step="0.01"
                                        value="{{ old('tax', $invoice->tax) }}" oninput="recalc()">%):
                                </td>
                                <td class="text-end small pb-2" id="display-tax">
                                    @php
                                        $discAmt = $invoice->subtotal * ($invoice->discount / 100);
                                        $taxAmt  = ($invoice->subtotal - $discAmt) * ($invoice->tax / 100);
                                    @endphp
                                    ${{ number_format($taxAmt, 2) }}
                                </td>
                            </tr>
                            <tr class="border-top">
                                <td class="fw-bold pt-2">Total:</td>
                                <td class="text-end fw-bold pt-2 fs-5" id="display-total">
                                    ${{ number_format($invoice->total, 2) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Note --}}
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="icon-base ti tabler-notes me-2 text-muted"></i>Note
                </h6>
            </div>
            <div class="card-body">
                <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                    placeholder="Thank you for your business.">{{ old('note', $invoice->note) }}</textarea>
                @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

    </div>

    {{-- ── Sidebar (col-lg-3) ────────────────────────────────────────────── --}}
    <div class="col-lg-3">
        <div class="card sticky-top" style="top: 80px;">
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-device-floppy me-1"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-outline-secondary">
                        Discard
                    </a>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label" for="status">Status</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                        @foreach(['draft','sent','paid','partial','overdue','cancelled'] as $s)
                            <option value="{{ $s }}" {{ old('status', $invoice->status) === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="small text-muted">
                    <p class="mb-1"><strong>Draft</strong> — saved, not sent</p>
                    <p class="mb-1"><strong>Sent</strong> — delivered to client</p>
                    <p class="mb-1"><strong>Paid</strong> — payment received</p>
                    <p class="mb-1"><strong>Partial</strong> — partial payment</p>
                    <p class="mb-1"><strong>Overdue</strong> — past due date</p>
                    <p class="mb-0"><strong>Cancelled</strong> — voided</p>
                </div>
            </div>
        </div>
    </div>

</div>
