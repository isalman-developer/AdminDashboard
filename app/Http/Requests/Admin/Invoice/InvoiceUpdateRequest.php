<?php

namespace App\Http\Requests\Admin\Invoice;

use Illuminate\Foundation\Http\FormRequest;



class InvoiceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('invoices.update') ?? false;
    }

    public function rules(): array
    {
        return [
            'status'         => 'required|in:draft,sent,paid,partial,overdue,cancelled',
            'client_name'    => 'required|string|max:255',
            'client_email'   => 'required|email|max:255',
            'client_phone'   => 'nullable|string|max:50',
            'client_company' => 'nullable|string|max:255',
            'client_address' => 'nullable|string|max:500',
            'issue_date'     => 'required|date',
            'due_date'       => 'required|date|after_or_equal:issue_date',
            'discount'       => 'nullable|numeric|min:0|max:100',
            'tax'            => 'nullable|numeric|min:0|max:100',
            'note'           => 'nullable|string|max:2000',
        ];
    }
}
