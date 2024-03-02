<?php

use App\Http\Controllers\AddressBookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/spa', [AddressBookController::class, 'spa']);

Route::get('/', [AddressBookController::class, 'index']);
Route::get('/create', [AddressBookController::class, 'create']);
Route::get('/{id}', [AddressBookController::class, 'show']);
Route::get('/{id}/edit', [AddressBookController::class, 'edit']);
Route::get('/{id}/delete', [AddressBookController::class, 'delete']);

Route::post('/create', [AddressBookController::class, 'store']);
Route::post('/{id}/edit', [AddressBookController::class, 'store']);
