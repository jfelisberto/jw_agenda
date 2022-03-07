<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Address;
use App\Http\Controllers\Api\Contact;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('contact')->group(function() {
    Route::get('/', [Contact::class, 'index']);
    Route::post('/', [Contact::class, 'store']);
    Route::get('/{id}', [Contact::class, 'show']);
    Route::get('/{id}/edit', [Contact::class, 'edit']);
    Route::put('/{id}', [Contact::class, 'update']);
    Route::delete('/{id}', [Contact::class, 'destroy']);
});

Route::prefix('address')->group(function() {
    Route::get('/', [Address::class, 'index']);
    Route::post('/', [Address::class, 'store']);
    Route::get('/{id}', [Address::class, 'show']);
    Route::get('/{id}/edit', [Address::class, 'edit']);
    Route::put('/{id}', [Address::class, 'update']);
    Route::delete('/{id}', [Address::class, 'destroy']);
});
