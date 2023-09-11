<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

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
    // echo "test";
    return view('Mitra.wizard');
});

Route::get('/map', function () {
    return view('Mitra.map');
});

Route::prefix('admin')->group(function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'logview'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.loginproses');
    Route::get('/register', [App\Http\Controllers\AdminController::class, 'register'])->name('admin.register');
    Route::post('/register', [App\Http\Controllers\AdminController::class, 'regadmin'])->name('admin.regadmin');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

    Route::prefix('pelanggan')->group(function () {
        Route::get('/', [App\Http\Controllers\PelangganController::class, 'index'])->name('admin.pelanggan');
        Route::get('/aktif', [App\Http\Controllers\PelangganController::class, 'aktif'])->name('admin.pelanggan.aktif');
        Route::get('/{id_mitra}', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('admin.perpel');
        Route::get('/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('admin.detail.pelanggan');
    });

    Route::prefix('barang')->group(function () {
        Route::get('/', [App\Http\Controllers\BarangController::class, 'index'])->name('admin.barang');
        // Route::get('/add', [App\Http\Controllers\BarangController::class, 'formadd'])->name('admin.form.barang');
        Route::post('/add', [App\Http\Controllers\BarangController::class, 'add'])->name('admin.tambah.barang');
        Route::get('/edit/{id_barang}', [App\Http\Controllers\BarangController::class, 'show'])->name('admin.edit.barang');
        Route::post('/edit/{id_barang}', [App\Http\Controllers\BarangController::class, 'edit'])->name('admin.proses.edit');
        Route::get('/{status}/{id_barang}', [App\Http\Controllers\BarangController::class, 'status'])->name('admin.status.barang');
        Route::post('/stok/plus', [App\Http\Controllers\BarangController::class, 'plusproses'])->name('admin.tambah.stok');
    });

    Route::prefix('mitra')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'mitra'])->name('admin.mitra');
        Route::get('/{id_mitra}', [App\Http\Controllers\AdminController::class, 'detail'])->name('admin.mitra.detail');
    });

    Route::prefix('spk')->group(function () {
        Route::get('/', [App\Http\Controllers\PurchaseOrderController::class, 'spkindex'])->name('admin.spk');
        Route::post('/save', [App\Http\Controllers\PurchaseOrderController::class, 'savespk'])->name('admin.dokumen.spk');
        Route::post('/savenew', [App\Http\Controllers\PurchaseOrderController::class, 'savenew'])->name('admin.dokumen.spknew');
        Route::get('/{id_mitra}', [App\Http\Controllers\PurchaseOrderController::class, 'spk'])->name('admin.spk.mitra');
    });

    Route::prefix('layanan')->group(function () {
        Route::get('/', [App\Http\Controllers\LayananController::class, 'index'])->name('admin.layanan');
    });

    Route::prefix('laypel')->group(function () {
        Route::get('/detail/{id_laypel}', [App\Http\Controllers\LaypelController::class, 'detail'])->name('admin.detail.laypel');
    });

    Route::prefix('purchase')->group(function () {
        Route::get('/', [App\Http\Controllers\PurchaseOrderController::class, 'index'])->name('admin.purchase');
        Route::get('/spk/{id_purchase_order}', [App\Http\Controllers\PurchaseOrderController::class, 'downloadspk'])->name('admin.downloadspk');
        Route::get('/ba/{id_purchase_order}', [App\Http\Controllers\PurchaseOrderController::class, 'downloadba'])->name('admin.downloadba');
    });

    Route::prefix('pinjaman')->group(function () {
        Route::get('/', [App\Http\Controllers\PinjamanController::class, 'list'])->name('admin.pinjaman');
        Route::get('/{id_pinjaman}', [App\Http\Controllers\PinjamanController::class, 'detail'])->name('admin.pinjaman.detail');
        Route::get('/1/{id_pinjaman}', [App\Http\Controllers\PinjamanController::class, 'status'])->name('admin.status.pinjaman');
        Route::get('/kembali', [App\Http\Controllers\PinjamanController::class, 'list'])->name('admin.pinjaman.kembali');
    });

    Route::prefix('tagihan')->group(function () {
        Route::get('/', [App\Http\Controllers\TagihanController::class, 'index'])->name('admin.cetak.tagihan');
        Route::get('/cetak/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\TagihanController::class, 'cetak'])->name('admin.cetak.tagihan.proses');
        Route::get('/cetakperbulan', [App\Http\Controllers\TagihanController::class, 'viewcetakperbulan'])->name('admin.cetak.perbulan');
        Route::get('/cetakbulan/{tglAwal}', [App\Http\Controllers\TagihanController::class, 'cetakTagihan'])->name('admin.cetak.perbulan.proses');
        Route::get('/cetak', [App\Http\Controllers\TagihanController::class, 'cetakindex'])->name('admin.cetak.tagihan.index');
    });

    Route::prefix('rekap')->group(function () {
        Route::get('/pinjaman', [App\Http\Controllers\RekapController::class, 'pinjaman'])->name('admin.rekap.pinjaman');
    });
});

Route::prefix('mitra')->group(function () {
    Route::get('/login', [App\Http\Controllers\MitraController::class, 'logview'])->name('mitra.login');
    Route::post('/login', [App\Http\Controllers\MitraController::class, 'login'])->name('mitra.loginproses');
    Route::get('/register', [App\Http\Controllers\MitraController::class, 'register'])->name('mitra.register');
    Route::post('/register', [App\Http\Controllers\MitraController::class, 'regmitra'])->name('mitra.regmitra');
    Route::get('/logout', [App\Http\Controllers\MitraController::class, 'logout'])->name('mitra.logout');
    Route::get('/', [App\Http\Controllers\MitraController::class, 'index'])->name('mitra.index');
    Route::get('/profil', [App\Http\Controllers\MitraController::class, 'profil'])->name('mitra.profil');
    Route::get('/edit/{id_mitra}', [App\Http\Controllers\MitraController::class, 'edit'])->name('mitra.edit.form');
    Route::post('/edit/{id_mitra}', [App\Http\Controllers\MitraController::class, 'update'])->name('mitra.edit.proses');
    Route::get('/reset', [App\Http\Controllers\ResetController::class, 'resetmitra'])->name('mitra.reset');
    Route::post('/reset', [App\Http\Controllers\ResetController::class, 'resetmitraproses'])->name('mitra.reset.post');
    Route::get('/reset/{token}', [App\Http\Controllers\ResetController::class, 'resetmitraemail'])->name('mitra.reset.email');
    Route::post('/reset/{token}', [App\Http\Controllers\ResetController::class, 'resetmitraprosesemail'])->name('mitra.reset.email.proses');

    Route::prefix('pelanggan')->group(function () {
        Route::get('', [App\Http\Controllers\PelangganController::class, 'index'])->name('mitra.pelanggan');
        Route::get('/aktif', [App\Http\Controllers\PelangganController::class, 'aktif'])->name('mitra.pelanggan.aktif');
        Route::get('/add', [App\Http\Controllers\PelangganController::class, 'formadd'])->name('mitra.form.pelanggan');
        Route::post('/add', [App\Http\Controllers\PelangganController::class, 'add'])->name('mitra.tambah.pelanggan');
        Route::get('/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'show'])->name('mitra.edit.pelanggan');
        Route::post('/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'edit'])->name('mitra.proses.edit');
        Route::get('/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('mitra.detail.pelanggan');
        Route::get('/{status}/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'status'])->name('mitra.status.pelanggan');
        Route::get('/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'modal'])->name('mitra.modal.pelanggan');
        Route::post('/search', [App\Http\Controllers\LaypelController::class, 'pelanggan'])->name('mitra.search.pelanggan');
    });

    Route::prefix('laypel')->group(function () {
        Route::get('/', [App\Http\Controllers\LaypelController::class, 'index'])->name('mitra.laypel');
        Route::post('/add', [App\Http\Controllers\LaypelController::class, 'laypel'])->name('mitra.tambah.laypel');
        Route::get('/detail/{id_laypel}', [App\Http\Controllers\LaypelController::class, 'detail'])->name('mitra.detail.laypel');
        Route::get('/edit/{id_laypel}', [App\Http\Controllers\PelangganController::class, 'viewlaypel'])->name('mitra.laypel.pelanggan');
        Route::post('/edit/{id_laypel}', [App\Http\Controllers\LaypelController::class, 'editlaypel'])->name('mitra.proses.editlaypel');
    });

    Route::prefix('pinjaman')->group(function () {
        Route::get('/', [App\Http\Controllers\PinjamanController::class, 'index'])->name('mitra.pinjaman');
        Route::post('/add', [App\Http\Controllers\PinjamanController::class, 'search'])->name('mitra.pinjam');
        Route::post('/barang', [App\Http\Controllers\PinjamanController::class, 'pinjam'])->name('mitra.pinjam.barang');
    });

    Route::prefix('layanan')->group(function () {
        Route::get('/', [App\Http\Controllers\LayananController::class, 'index'])->name('mitra.layanan');
        Route::get('/add', [App\Http\Controllers\LayananController::class, 'formadd'])->name('mitra.form.layanan');
        Route::post('/add', [App\Http\Controllers\LayananController::class, 'add'])->name('mitra.tambah.layanan');
        Route::get('/edit/{id_layanan}', [App\Http\Controllers\LayananController::class, 'show'])->name('mitra.edit.layanan');
        Route::post('/edit/{id_layanan}', [App\Http\Controllers\LayananController::class, 'edit'])->name('mitra.proses.editlay');
        Route::post('/search', [App\Http\Controllers\LaypelController::class, 'layanan'])->name('mitra.search.layanan');
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', [App\Http\Controllers\LaypelController::class, 'trans'])->name('mitra.transaksi');
        Route::get('/detail/{id_transaksi}', [App\Http\Controllers\LaypelController::class, 'detailtrans'])->name('mitra.detail.transaksi');
    });

    Route::prefix('order')->group(function(){
        Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('mitra.order');
        Route::get('/map/{id_mitra}', [App\Http\Controllers\OrderController::class, 'map'])->name('mitra.map.order');
        Route::post('/save', [App\Http\Controllers\OrderController::class, 'store'])->name('mitra.order.save');
        Route::get('/list', [App\Http\Controllers\OrderController::class, 'list'])->name('mitra.order.list');
        Route::get('/nego/{id_order}', [App\Http\Controllers\OrderController::class, 'modal'])->name('mitra.order.modal');
        Route::post('/nego/{id_order}', [App\Http\Controllers\OrderController::class, 'nego'])->name('mitra.order.nego');
    });

    Route::prefix('tagihan')->group(function () {
        Route::get('/', [App\Http\Controllers\TagihanController::class, 'index'])->name('mitra.cetak.tagihan');
        Route::get('/cetak/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\TagihanController::class, 'cetak'])->name('mitra.cetak.tagihan.proses');
        Route::get('/cetakperbulan', [App\Http\Controllers\TagihanController::class, 'viewcetakperbulan'])->name('mitra.cetak.perbulan');
        Route::get('/cetakbulan/{tglAwal}', [App\Http\Controllers\TagihanController::class, 'cetakTagihan'])->name('mitra.cetak.perbulan.proses');
        // Route::post('/bayar/{id_laypel}', [App\Http\Controllers\TagihanController::class, 'bayar'])->name('mitra.bayar');
        Route::get('/bayar/{id_laypel}', [App\Http\Controllers\TagihanController::class, 'detail'])->name('mitra.bayar.detail');
        Route::put('/bayar/', [App\Http\Controllers\TagihanController::class, 'bayar'])->name('mitra.tagihan.bayar');
        Route::get('/updatetanggal/{id_bayar}', [App\Http\Controllers\TagihanController::class, 'updatetanggal'])->name('mitra.tagihan.updatetanggal');
        Route::get('/updatetelat/{id_bayar}', [App\Http\Controllers\TagihanController::class, 'updatetelat'])->name('mitra.tagihan.updatetelat');
        Route::get('/cetak', [App\Http\Controllers\TagihanController::class, 'cetakindex'])->name('mitra.cetak.tagihan.index');
    });

    Route::prefix('rekap')->group(function () {
        Route::get('/pinjaman', [App\Http\Controllers\RekapController::class, 'pinjaman'])->name('mitra.rekap.pinjaman');
        Route::get('/tagihan', [App\Http\Controllers\RekapController::class, 'tagihan'])->name('mitra.rekap.tagihan');
        Route::get('/detailtagpel/{id_tagihan}', [App\Http\Controllers\RekapController::class, 'detailtagpel'])->name('mitra.detailtagpel');
        Route::get('/view/export', [App\Http\Controllers\RekapController::class, 'viewtagpel'])->name('mitra.view.export');
        Route::get('/tagihan/export/{tgl_awal}/{tgl_akhir}', [App\Http\Controllers\RekapController::class, 'export'])->name('mitra.export');
    });

    Route::get('/po', [App\Http\Controllers\PurchaseOrderController::class, 'po'])->name('mitra.po');
    Route::post('/send/po', [App\Http\Controllers\PurchaseOrderController::class, 'proses'])->name('mitra.send.po');
    Route::get('/barang', [App\Http\Controllers\BarangController::class, 'daftar'])->name('mitra.barang');
    Route::get('/statuslay/{status}/{id_layanan}', [App\Http\Controllers\LayananController::class, 'status'])->name('mitra.status.layanan');
    Route::get('/spk', [App\Http\Controllers\PurchaseOrderController::class, 'spk'])->name('mitra.spk');
    Route::get('/map/{id_mitra}', [App\Http\Controllers\MitraController::class, 'map'])->name('mitra.map');

});

Route::prefix('staff')->group(function () {
    Route::get('/login', [App\Http\Controllers\StaffController::class, 'logview'])->name('staff.login');
    Route::post('/login', [App\Http\Controllers\StaffController::class, 'login'])->name('staff.loginproses');
    Route::get('/register', [App\Http\Controllers\StaffController::class, 'register'])->name('staff.register');
    Route::post('/register', [App\Http\Controllers\StaffController::class, 'regstaff'])->name('staff.regstaff');
    Route::get('/logout', [App\Http\Controllers\StaffController::class, 'logout'])->name('staff.logout');
    Route::get('/', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');

    Route::prefix('pelanggan')->group(function () {
        Route::get('/', [App\Http\Controllers\PelangganController::class, 'index'])->name('staff.pelanggan');
        Route::get('/aktif', [App\Http\Controllers\PelangganController::class, 'aktif'])->name('staff.pelanggan.aktif');
        Route::get('/{id_mitra}', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('staff.perpel');
        Route::get('/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('staff.detail.pelanggan');
    });

    Route::prefix('laypel')->group(function () {
        Route::get('/detail/{id_laypel}', [App\Http\Controllers\LaypelController::class, 'detail'])->name('staff.detail.laypel');
    });
});
