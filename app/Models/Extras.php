<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extras extends Model
{
    use HasFactory;

    protected $table = 'extras';
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'cat_id',
    ];

}

