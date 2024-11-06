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
    ];

    // If products and extras are stored as JSON, you can cast them to arrays
    protected $casts = [
        'products' => 'array',
        'extras' => 'array',
    ];
}
