<?php

use App\Http\Controllers\MenuControl;
use Illuminate\Support\Facades\Route;

Route::get('/menu/{category}', [MenuControl::class, 'drinkItems']);
