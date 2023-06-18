<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_total',
        'remarks',
        'supplier_id',
        'user_id',
        'voucher_id'
    ];
}
