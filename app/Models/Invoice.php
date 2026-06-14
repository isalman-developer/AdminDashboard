<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'order_id',
        'invoice_number',
        'status',
        'client_name',
        'client_email',
        'client_phone',
        'client_company',
        'client_address',
        'issue_date',
        'due_date',
        'subtotal',
        'discount',
        'tax',
        'total',
        'note',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date'   => 'date',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

}
