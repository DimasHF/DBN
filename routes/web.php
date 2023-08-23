<?php

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

Route::get('/', function () {
    return view('index');
});

Route::prefix('admin')->group(function(){
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'logview'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.loginproses');
    Route::get('/register', [App\Http\Controllers\AdminController::class, 'register'])->name('admin.register');
    Route::post('/register', [App\Http\Controllers\AdminController::class, 'regadmin'])->name('admin.regadmin');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('admin.pelanggan');
    Route::get('/pelangggan/{id_mitra}', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('mitra.perpel');
    Route::get('/pelanggan/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('detail.pelanggan');
});

Route::prefix('mitra')->group(function(){
    Route::get('/login', [App\Http\Controllers\MitraController::class, 'logview'])->name('mitra.login');
    Route::post('/login', [App\Http\Controllers\MitraController::class, 'login'])->name('mitra.loginproses');
    Route::get('/register', [App\Http\Controllers\MitraController::class, 'register'])->name('mitra.register');
    Route::post('/register', [App\Http\Controllers\MitraController::class, 'regmitra'])->name('mitra.regmitra');
    Route::get('/logout', [App\Http\Controllers\MitraController::class, 'logout'])->name('mitra.logout');
    Route::get('/', [App\Http\Controllers\MitraController::class, 'index'])->name('mitra.index');
    Route::get('/profil', [App\Http\Controllers\MitraController::class, 'profil'])->name('mitra.profil');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('mitra.pelanggan');
    Route::get('/pelanggan/add', [App\Http\Controllers\PelangganController::class, 'formadd'])->name('form.pelanggan');
    Route::post('/pelanggan/add', [App\Http\Controllers\PelangganController::class, 'add'])->name('tambah.pelanggan');
    Route::get('/pelangggan/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'show'])->name('edit.pelanggan');
    Route::post('/pelangggan/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'edit'])->name('proses.edit');

});

Route::prefix('staff')->group(function(){
    Route::get('/login', [App\Http\Controllers\StaffController::class, 'logview'])->name('staff.login');
    Route::post('/login', [App\Http\Controllers\StaffController::class, 'login'])->name('staff.loginproses');
    Route::get('/register', [App\Http\Controllers\StaffController::class, 'register'])->name('staff.register');
    Route::post('/register', [App\Http\Controllers\StaffController::class, 'regstaff'])->name('staff.regstaff');
    Route::get('/logout', [App\Http\Controllers\StaffController::class, 'logout'])->name('staff.logout');
    Route::get('/', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('staff.pelanggan');
    Route::get('/pelangggan/{id_mitra}', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('staff.perpel');
    Route::get('/pelanggan/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('detail.pelanggan.staff');
});
