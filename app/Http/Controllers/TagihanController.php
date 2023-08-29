<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    //Index
    public function index()
    {
        return view('Tagihan.index');
    }

    //cetak
    public function cetak($tgl_awal, $tgl_akhir)
    {
        // $cetak = collect("Awal".$tgl_awal." ".$tgl_akhir);
        // $cetak->dd();

        $cetak = DB::table('transaksis')->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
        //$cetak->dd();
        return view('Tagihan.cetak', compact('cetak'));
    }

    //View Cetak Perbulan
    public function viewcetakperbulan()
    {
        return view('Tagihan.cetakperbulan');
    }

    public function cetakTagihan(Request $request, $tglAwal, $tglAkhir)
    {
        // Parse tanggal dari string ke objek Carbon
        $startDate = Carbon::createFromFormat('Y-m-d', $tglAwal);
        
        // Menambahkan 30 hari untuk tanggal akhir
        $endDate = $startDate->copy()->addDays(30);

        // Lakukan query atau operasi lain sesuai kebutuhan Anda
        $tagihanData = Transaksi::whereDate('tanggal', $endDate)
                                  ->get();

        dd($startDate, $endDate, $tagihanData);

        // Kemudian Anda bisa mereturn view dengan data yang ingin dicetak
        return view('Tagihan.cetakperbulan', compact('tagihanData'));
    }
}
