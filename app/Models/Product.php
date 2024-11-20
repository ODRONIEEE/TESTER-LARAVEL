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
        'espresso_id',
        'type_id',
        'sugar_id',

    ];

     // Define the relationship to Type
     public function type()
     {
         return $this->belongsTo(ProductType::class, 'type_id');
     }

     // Define the relationship to Category
     public function category()
     {
         return $this->belongsTo(Category::class, 'cat_id');
     }

}
