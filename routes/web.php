<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App;

#Route::get('/', [App::class, 'index'])->name('dashboard');
Route::get('/{any}', [App::class, 'index'])->where('any', '.*');
