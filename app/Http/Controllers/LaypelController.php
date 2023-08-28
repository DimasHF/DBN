<?php

namespace App\Http\Controllers;

use App\Models\Laypel;
use App\Models\Tagihan;
use App\Models\Transaksi;
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
    public function pelanggan(Request $request)
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $search = $request->search;

        if ($search == '') {
            $cari = DB::table('pelanggans')->orderBy('nama', 'asc')
                ->select('pelanggans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->get();
        } else {
            $cari = DB::table('pelanggans')->orderBy('nama', 'asc')
                ->select('pelanggans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->where('nama', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $pelanggan) {
            $response[] = array("value" => $pelanggan->nama, "label1" => $pelanggan->id_pelanggan);
        }

        return response()->json($response);
    }

    //Search Layanan
    public function layanan(Request $request)
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $search = $request->search;

        if ($search == '') {
            $cari = DB::table('layanans')->orderBy('nama', 'asc')
                ->select('layanans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->get();
        } else {
            $cari = DB::table('layanans')->orderBy('nama', 'asc')
                ->select('layanans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('status', '=', '1')
                ->where('nama', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $suppli) {
            $response[] = array("value" => $suppli->nama, "id_layanan" => $suppli->id_layanan, "layanan" => $suppli->nama, "harga" => $suppli->harga, "bandwidth" => $suppli->bandwidth);
        }

        return response()->json($response);
    }

    //View Data Barang Untuk Dipinjam
    public function laypel(Request $request)
    {

        $autoId = DB::table('transaksis')->select(DB::raw('MAX(RIGHT(id_transaksi,4)) as autoId'));
        $kds = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kds = sprintf("%04s", $tmp);
            }
        } else {
            $kds = "0001";
        }

        if ($request->nomor == null) {
            //Gagal
            // dd($request);
        } else {
            $count_barang = count($request->nomor);
            for ($i = 0; $i < $count_barang; $i++) {

                //Berhasil
                $lay = new Laypel;
                $lay->id_transaksi = ("TR-" . $kds);
                $lay->id_pelanggan = $request->id_pelanggan[$i];
                $lay->id_layanan = $request->id_layanan[$i];
                $lay->pajak = $request->pajak[$i];
                $lay->biaya = $request->subtotalpajak[$i];
                $lay->status = 1;
                //dd($lay);
                $lay->save();

            }

            //transaksi
            $transaksi = new Transaksi;
            $transaksi->id_transaksi = ("TR-" . $kds);
            $transaksi->tanggal = $request->tanggal;
            $transaksi->total = $request->totalpajak;
            $transaksi->status = 1;
            //dd($transaksi);
            $transaksi->save();

            //View Alert
            return redirect()->route('mitra.pelanggan.aktif')->with('alert', 'Layanan Berhasil Ditambahkan');
        }

        return view('Laypel.index');
    }

    //Detail Layanan Pelanggan
    public function detail($id_transaksi)
    {
        $detail = new Transaksi();
        $detail = $detail->where('id_transaksi', $id_transaksi)->first();
        $detail2 = new Laypel();
        $detaillayanan = $detail2->where('id_transaksi', $id_transaksi)->join('layanans', 'laypels.id_layanan', '=', 'layanans.id_layanan')->get();
        $detailpelanggan = $detail2->where('id_transaksi', $id_transaksi)->join('pelanggans', 'laypels.id_pelanggan', '=', 'pelanggans.id_pelanggan')
                                ->join('mitras', 'pelanggans.id_mitra', '=', 'mitras.id_mitra')->select('pelanggans.*', 'mitras.nama as nama_mitra')
                                ->first();

        return view('Laypel.detail', compact('detail', 'detaillayanan', 'detailpelanggan'));
    }
}
