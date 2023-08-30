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
            $cari = DB::table('barangs')->orderBy('nama_bar', 'asc')
                ->select('id_barang', 'nama_bar', 'stok', 'status')
                ->where('status', '=', '1')
                ->get();
        } else {
            $cari = DB::table('barangs')->orderBy('nama_bar', 'asc')
                ->select('id_barang', 'nama_bar', 'stok', 'status')
                ->where('status', '=', '1')
                ->where('nama_bar', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $suppli) {
            $response[] = array("value" => $suppli->nama_bar, "label1" => $suppli->id_barang, "label2" => $suppli->stok, "status" => $suppli->status);
        }

        return response()->json($response);
    }

    //View Data Barang Untuk Dipinjam
    public function pinjam(Request $request)
    {
        $autoId = DB::table('pinjamen')->select(DB::raw('MAX(RIGHT(id_pinjaman,4)) as autoId'));
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

            for ($i = 0; $i < $count; $i++) {
                $detail = new DetailPinjam;
                $detail->id_pinjaman = ('PIN' . $kd);
                $detail->id_barang = $request->id_barang[$i];
                $detail->jumlah = $request->jumlah[$i];

                //dd($detail);
                $detail->save();

                $find = $detail->id_barang;
                $barang = Barang::where('id_barang', $find)->first();
                $jumlahin = ((float)($barang->stok)) -  ((float)($detail->jumlah));
                $barang->stok = $jumlahin;

                //dd($jumlahin);
                $barang->save();
            }

            $pinjam = new Pinjaman;
            $pinjam->id_pinjaman = ('PIN' . $kd);
            $pinjam->id_mitra = $user;
            $pinjam->tanggal = date('Y-m-d');
            $pinjam->status = '0';
            //dd($pinjam);
            $pinjam->save();
        }

        return redirect()->back()->with('alert', 'Data Berhasil Ditambahkan');
    }

    //View Pinjaman
    public function list()
    {
        $pinjaman = Pinjaman::where('status', 0)->get();
        return view('Pinjaman.daftar', ['pinjaman' => $pinjaman]);
    }

    public function detail($id_pinjaman)
    {
        $pinjaman = Pinjaman::where('id_pinjaman', $id_pinjaman)->join('mitras', 'mitras.id_mitra', '=', 'pinjamen.id_mitra')->first();
        $detail = DetailPinjam::where('id_pinjaman', $id_pinjaman)->join('barangs', 'barangs.id_barang', '=', 'detail_pinjams.id_barang')->get();
        return view('Pinjaman.detail', ['pinjaman' => $pinjaman, 'detail' => $detail]);
    }

    public function status($id_pinjaman)
    {
        $pinjaman = Pinjaman::where('id_pinjaman', $id_pinjaman)->first();
        $pinjaman->status = 1;
        $pinjaman->save();

        return redirect()->back()->with('alert', 'Data Berhasil Diubah');
    }
    
    public function kembali()
    {
        $pinjaman = Pinjaman::where('status', 1)->get();
        return view('Pinjaman.kembali', ['pinjaman' => $pinjaman]);
    }
}
