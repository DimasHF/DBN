<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
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
}
