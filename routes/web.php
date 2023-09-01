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

Route::get('/test', function () {
    return view('Mitra.edit');
});

Route::get('/map', function () {
    return view('Mitra.map');
});

Route::prefix('admin')->group(function(){
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'logview'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.loginproses');
    Route::get('/register', [App\Http\Controllers\AdminController::class, 'register'])->name('admin.register');
    Route::post('/register', [App\Http\Controllers\AdminController::class, 'regadmin'])->name('admin.regadmin');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('admin.pelanggan');
    Route::get('/pelanggan/aktif', [App\Http\Controllers\PelangganController::class, 'aktif'])->name('admin.pelanggan.aktif');
    Route::get('/pelangggan/{id_mitra}', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('admin.perpel');
    Route::get('/pelanggan/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('admin.detail.pelanggan');

    Route::get('/barang', [App\Http\Controllers\BarangController::class, 'index'])->name('admin.barang');
    Route::get('/barang/add', [App\Http\Controllers\BarangController::class, 'formadd'])->name('admin.form.barang');
    Route::post('/barang/add', [App\Http\Controllers\BarangController::class, 'add'])->name('admin.tambah.barang');
    Route::get('/barang/edit/{id_barang}', [App\Http\Controllers\BarangController::class, 'show'])->name('admin.edit.barang');
    Route::post('/barang/edit/{id_barang}', [App\Http\Controllers\BarangController::class, 'edit'])->name('admin.proses.edit');

    Route::get('/mitra', [App\Http\Controllers\AdminController::class, 'mitra'])->name('admin.mitra');
    Route::get('/mitra/{id_mitra}', [App\Http\Controllers\AdminController::class, 'detail'])->name('admin.mitra.detail');

    Route::get('/spk/{id_mitra}', [App\Http\Controllers\PurchaseOrderController::class, 'spk'])->name('admin.spk');

    Route::get('/layanan', [App\Http\Controllers\LayananController::class, 'index'])->name('admin.layanan');

    Route::get('/purchase', [App\Http\Controllers\PurchaseOrderController::class, 'index'])->name('admin.purchase');
    Route::get('/download/spk/{id_purchase_order}', [App\Http\Controllers\PurchaseOrderController::class, 'downloadspk'])->name('admin.downloadspk');
    Route::get('/download/ba/{id_purchase_order}', [App\Http\Controllers\PurchaseOrderController::class, 'downloadba'])->name('admin.downloadba');

    Route::get('/pinjaman', [App\Http\Controllers\PinjamanController::class, 'list'])->name('admin.pinjaman');
    Route::get('/pinjaman/{id_pinjaman}', [App\Http\Controllers\PinjamanController::class, 'detail'])->name('admin.pinjaman.detail');
    Route::get('/pinjaman/1/{id_pinjaman}', [App\Http\Controllers\PinjamanController::class, 'status'])->name('admin.status.pinjaman');
    Route::get('/pinjaman/kembali', [App\Http\Controllers\PinjamanController::class, 'list'])->name('admin.pinjaman.kembali');

    Route::get('/rekap/pinjaman', [App\Http\Controllers\RekapController::class, 'pinjaman'])->name('admin.rekap.pinjaman');

});

Route::prefix('mitra')->group(function(){
    Route::get('/login', [App\Http\Controllers\MitraController::class, 'logview'])->name('mitra.login');
    Route::post('/login', [App\Http\Controllers\MitraController::class, 'login'])->name('mitra.loginproses');
    Route::get('/register', [App\Http\Controllers\MitraController::class, 'register'])->name('mitra.register');
    Route::post('/register', [App\Http\Controllers\MitraController::class, 'regmitra'])->name('mitra.regmitra');
    Route::get('/logout', [App\Http\Controllers\MitraController::class, 'logout'])->name('mitra.logout');
    Route::get('/', [App\Http\Controllers\MitraController::class, 'index'])->name('mitra.index');
    Route::get('/profil', [App\Http\Controllers\MitraController::class, 'profil'])->name('mitra.profil');
    Route::get('/edit/{id_mitra}', [App\Http\Controllers\MitraController::class, 'edit'])->name('mitra.edit.form');
    Route::post('/edit/{id_mitra}', [App\Http\Controllers\MitraController::class, 'update'])->name('mitra.edit.proses');
    
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('mitra.pelanggan');
    Route::get('/pelanggan/aktif', [App\Http\Controllers\PelangganController::class, 'aktif'])->name('mitra.pelanggan.aktif');
    Route::get('/pelanggan/add', [App\Http\Controllers\PelangganController::class, 'formadd'])->name('mitra.form.pelanggan');
    Route::post('/pelanggan/add', [App\Http\Controllers\PelangganController::class, 'add'])->name('mitra.tambah.pelanggan');
    Route::get('/pelangggan/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'show'])->name('mitra.edit.pelanggan');
    Route::post('/pelangggan/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'edit'])->name('mitra.proses.edit');

    Route::get('/po', [App\Http\Controllers\PurchaseOrderController::class, 'po'])->name('mitra.po');
    Route::post('/send/po', [App\Http\Controllers\PurchaseOrderController::class, 'proses'])->name('mitra.send.po');

    Route::get('/pinjaman', [App\Http\Controllers\PinjamanController::class, 'index'])->name('mitra.pinjaman');
    Route::post('/pinjaman/add', [App\Http\Controllers\PinjamanController::class, 'search'])->name('mitra.pinjam');
    Route::post('/pinjaman/barang', [App\Http\Controllers\PinjamanController::class, 'pinjam'])->name('mitra.pinjam.barang');

    Route::get('/barang', [App\Http\Controllers\BarangController::class, 'daftar'])->name('mitra.barang');

    Route::get('/layanan', [App\Http\Controllers\LayananController::class, 'index'])->name('mitra.layanan');
    Route::get('/layanan/add', [App\Http\Controllers\LayananController::class, 'formadd'])->name('mitra.form.layanan');
    Route::post('/layanan/add', [App\Http\Controllers\LayananController::class, 'add'])->name('mitra.tambah.layanan');
    Route::get('/layanan/edit/{id_layanan}', [App\Http\Controllers\LayananController::class, 'show'])->name('mitra.edit.layanan');
    Route::post('/layanan/edit/{id_layanan}', [App\Http\Controllers\LayananController::class, 'edit'])->name('mitra.proses.editlay');

    Route::get('/laypel', [App\Http\Controllers\LaypelController::class, 'index'])->name('mitra.laypel');
    Route::post('/pelanggan/search', [App\Http\Controllers\LaypelController::class, 'pelanggan'])->name('mitra.search.pelanggan');
    Route::post('/layanan/search', [App\Http\Controllers\LaypelController::class, 'layanan'])->name('mitra.search.layanan');
    Route::post('/laypel/add', [App\Http\Controllers\LaypelController::class, 'laypel'])->name('mitra.tambah.laypel');
    Route::get('/laypel/detail/{id_laypel}', [App\Http\Controllers\LaypelController::class, 'detail'])->name('mitra.detail.laypel');
    Route::get('/transaksi', [App\Http\Controllers\LaypelController::class, 'trans'])->name('mitra.transaksi');
    Route::get('/transaksi/detail/{id_transaksi}', [App\Http\Controllers\LaypelController::class, 'detailtrans'])->name('mitra.detail.transaksi');
    // Route::post('/cari/layanan2', [App\Http\Controllers\LaypelController::class, 'layanan2'])->name('mitra.search.layanan');

    Route::get('/spk', [App\Http\Controllers\PurchaseOrderController::class, 'spk'])->name('mitra.spk');

    Route::get('/map/{id_mitra}', [App\Http\Controllers\MitraController::class, 'map'])->name('mitra.map');

    Route::get('/tagihan', [App\Http\Controllers\TagihanController::class, 'index'])->name('mitra.cetak.tagihan');
    Route::get('/tagihan/cetak/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\TagihanController::class, 'cetak'])->name('mitra.cetak.tagihan.proses');
    Route::get('/tagihan/cetakperbulan', [App\Http\Controllers\TagihanController::class, 'viewcetakperbulan'])->name('mitra.cetak.perbulan');
    Route::get('/tagihan/cetakbulan/{tglAwal}/{tglAkhir}', [App\Http\Controllers\TagihanController::class, 'cetakTagihan'])->name('mitra.cetak.perbulan.proses');
    // Route::post('/tagihan/bayar/{id_laypel}', [App\Http\Controllers\TagihanController::class, 'bayar'])->name('mitra.bayar');
    Route::post('/tagihan/bayar', [App\Http\Controllers\TagihanController::class, 'update'])->name('mitra.bayar.proses');

    Route::get('/tagihan/bayar/{id_laypel}', [App\Http\Controllers\TagihanController::class, 'detail'])->name('mitra.bayar.detail');
    Route::put('/tagihan/bayar/', [App\Http\Controllers\TagihanController::class, 'bayar'])->name('mitra.tagihan.bayar');
    Route::get('/tagihan/updatetanggal/{id_bayar}', [App\Http\Controllers\TagihanController::class, 'updatetanggal'])->name('mitra.tagihan.updatetanggal');
    Route::get('/tagihan/updatetelat/{id_bayar}', [App\Http\Controllers\TagihanController::class, 'updatetelat'])->name('mitra.tagihan.updatetelat');

    Route::get('/rekap/pinjaman', [App\Http\Controllers\RekapController::class, 'pinjaman'])->name('mitra.rekap.pinjaman');

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
