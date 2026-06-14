@extends('admin.layouts.admin')

@section('title', 'Edit ' . $invoice->invoice_number)

@section('content')

<form method="POST" action="{{ route('admin.invoices.update', $invoice) }}" id="invoice-form">
    @csrf
    @method('PUT')
    @include('admin.invoices.form', ['invoice' => $invoice, 'invoiceNumber' => $invoice->invoice_number])
</form>

@endsection

@push('scripts')
@include('admin.invoices.form-script')
@endpush
