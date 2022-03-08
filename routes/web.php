<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App;

Route::get('/{any}', [App::class, 'index'])->where('any', '.*');
