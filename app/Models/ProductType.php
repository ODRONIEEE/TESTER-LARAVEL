<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'type';

    protected $fillable = [
        'name'
    ];

     // Define the inverse relationship to Product
     public function products()
     {
         return $this->hasMany(Product::class, 'type_id');
     }
}
