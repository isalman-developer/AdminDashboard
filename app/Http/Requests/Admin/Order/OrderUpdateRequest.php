<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('orders.update') ?? false;
    }

    public function rules(): array
    {
        return [
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:50',
            'address'        => 'required|string|max:500',
            'city'           => 'required|string|max:100',
            'state'          => 'nullable|string|max:100',
            'zip_code'       => 'nullable|string|max:20',
            'country'        => 'required|string|max:100',
            'notes'          => 'nullable|string|max:1000',
            'payment_status' => 'required|in:pending,paid,refunded',
            'order_status'   => 'required|in:pending,processing,shipped,delivered,cancelled',
        ];
    }
}
