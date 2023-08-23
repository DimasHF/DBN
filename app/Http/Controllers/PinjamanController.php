<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPinjam;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PinjamanController extends Controller
{
    //View Pinjaman
    public function index()
    {
        $pinjam = Pinjaman::all();
        return view('Pinjaman.index', ['pinjam' => $pinjam]);
    }

    //Search Barang
    public function search(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $cari = DB::table('barangs')->orderBy('nama', 'asc')
                ->select('id_barang', 'nama', 'stok', 'status')
                ->where('status', '=', '1')
                ->get();
        } else {
            $cari = DB::table('barangs')->orderBy('nama', 'asc')
                ->select('id_barang', 'nama', 'stok', 'status')
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
        $autoId = DB::table('pinjamans')->select(DB::raw('MAX(RIGHT(id_pinjaman,4)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        $user = Auth::guard('mitra')->user()->id_mitra;

        if ($request->nomor == null) {
            //Gagal
            dd($request);
        } else {
            //Berhasil
            $count = count($request->nomor);
            
            $pinjam = new Pinjaman;
            $pinjam->id_pinjaman = 'PIN'.$kd;
            $pinjam->id_mitra = $user;
            $pinjam->tanggal = $request->tanggal;
            //dd($pinjam);
            $pinjam->save();

            for ($i = 0; $i < $count; $i++) {
                $detail = new DetailPinjam;
                $detail->id_pinjaman = 'PIN'.$kd[$i];
                $detail->id_barang = $request->id_barang[$i];
                $detail->jumlah = $request->jumlah[$i];

                //dd($detail);
                $detail->save();

                $find = $detail->id_barang;
                $barang = Barang::where('id_barang', $find)->first();
                $jumlahin = ((float)($barang->stok)) + ((float)($detail->jumlah));
                $barang->stok = $jumlahin;

                //dd($jumlahin);
                $barang->save();
            }
        }

        return view('Barang.pinjam');
    }
}
