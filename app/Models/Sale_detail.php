<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'sub_total',
        'sale_id',
        'product_id',
    ];
}
