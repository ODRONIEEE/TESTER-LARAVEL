<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [

        'product_code',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'cat_id',
        'sugar',
        'type_id',
        'espresso_id',

    ];

}
