<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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
            'order_type',
    ];

  
    protected $casts = [
        'products' => 'array',
        'extras' => 'array',
        'dateCreated' => 'datetime',
    ];
}

