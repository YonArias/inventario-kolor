<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'stock',
        'category_id',
        'price',
        'mark_id',
        'date_manufacture',
        'description',
        'state',
    ];
}
