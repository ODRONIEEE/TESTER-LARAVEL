<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $table = 'transaction';


    protected $fillable = [
        'user_id',
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
        'products' => 'array',
        'extras' => 'array',
        'dateCreated' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Ensure `user_id` exists in the `transaction` table
    }
}

