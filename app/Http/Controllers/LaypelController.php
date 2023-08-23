<?php

namespace App\Http\Controllers;

use App\Models\Laypel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaypelController extends Controller
{
    //View Layanan Pelanggan
    public function index()
    {
        return view('Laypel.index');
    }

    //Layanan Pelanggan
    public function layanan(Request $request)
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $search = $request->search;

        if ($search == '') {
            $cari = DB::table('layanans')->orderBy('nama', 'asc')
                ->select('layanans')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->get();
        } else {
            $cari = DB::table('layanans')->orderBy('nama', 'asc')
                ->select('id_barang', 'nama', 'stok', 'status')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->where('nama', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $layanan) {
            $response[] = array("layanan" => $layanan->layanan);
        }

        return response()->json($response);
    }

    //Search Pelanggan
    public function pelanggan(Request $request)
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $search = $request->search;

        if ($search == '') {
            $cari = DB::table('pelanggans')->orderBy('nama', 'asc')
                ->select('*')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->get();
        } else {
            $cari = DB::table('pelanggans')->orderBy('nama', 'asc')
                ->select('*')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->where('nama', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $suppli) {
            $response[] = array("value" => $suppli->nama, "id_barang" => $suppli->id_barang, "stok" => $suppli->stok, "status" => $suppli->status);
        }

        return response()->json($response);
    }

    //View Data Barang Untuk Dipinjam
    public function pinjam(Request $request)
    {
        $autoId = DB::table('laypels')->select(DB::raw('MAX(RIGHT(id_laypel,4)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        if ($request->nomor == null) {
            //Gagal
            dd($request);
        } else {
            //Berhasil
            $lay = new Laypel;
            $lay->id_laypel = 'LP' . date('Y-m-d') . $kd;
            $lay->id_pelanggan = $request->id_pelanggan;
            $lay->id_layanan = $request->id_layanan;
            $lay->tanggal = $request->tanggal;
            $lay->pajak = $request->pajak;
            $lay->status = $request->status;
            //dd($lay);
            $lay->save();

        }

        return view('Laypel.index');
    }
}
