<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'invoices_data',
        'due_data',
        'product',
        'section',
        'discount',
        'rate_vat',
        'vlue_vat',
        'total',
        'status',
        'value_status',
        'note',
        'user',
    ];
}
