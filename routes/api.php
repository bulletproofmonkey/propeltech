<?php

use App\Http\Controllers\Api\AddressBookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', [AddressBookController::class, 'getAll']);
Route::get('/{id}', [AddressBookController::class, 'get']);
Route::post('/', [AddressBookController::class, 'create']);
Route::patch('/{id}', [AddressBookController::class, 'update']);
Route::delete('/{id}', [AddressBookController::class, 'delete']);
