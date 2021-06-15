<?php

use Illuminate\Support\Facades\Route;

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

// Public routes
Route::post(
    '/register',
    'App\Http\Controllers\API\v1\AuthController@register'
);

Route::post(
    '/login',
    'App\Http\Controllers\API\v1\AuthController@login'
);

// Protected routes
Route::middleware(['auth:api'])->group(function () {

    // Transaction operation
    Route::post(
        '/transaction',
        'App\Http\Controllers\API\v1\TransactionController@transaction'
    )
        ->middleware('transaction.validation');
});
