<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App::class, 'index'])->name('dashboard');
#Route::get('/{any}', [App::class, 'index'])->where('any', '.*');
