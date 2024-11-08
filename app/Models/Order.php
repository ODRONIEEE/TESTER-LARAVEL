<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $fillable = [
        'customer_name',
        'products',
        'extras',
        'total_price',
        'p_method',
        'dateCreated',
          'status',
        'order_type',
    ];

    protected $casts = [
        'products' => 'array',  // Ensure products is cast to an array
        'extras' => 'array',    // Ensure extras is cast to an array
    ];
}