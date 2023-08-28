<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/mitra/konfimasi/{status}/{id_mitra}', [App\Http\Controllers\AdminController::class, 'konfirmasi'])->name('mitra.konfimasi');

Route::post('/mitra/aktif/{status}/{id_mitra}', [App\Http\Controllers\AdminController::class, 'aktif'])->name('mitra.aktif');