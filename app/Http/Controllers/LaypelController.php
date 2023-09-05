<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Layanan;
use App\Models\Laypel;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Carbon\Carbon;
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
            $cari = DB::table('pelanggans')->orderBy('nama_pel', 'asc')
                ->select('pelanggans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('statuspel', '=', '1')
                ->get();
        } else {
            $cari = DB::table('pelanggans')->orderBy('nama_pel', 'asc')
                ->select('pelanggans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('statuspel', '=', '1')
                ->where('nama_pel', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $pelanggan) {
            $response[] = array("value" => $pelanggan->nama_pel, "label1" => $pelanggan->id_pelanggan);
        }

        return \response()->json($response);
    }

    //Search Layanan
    public function layanan(Request $request)
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $search = $request->search;

        if ($search == '') {
            $cari = Layanan::orderBy('nama_lay', 'asc')
                ->select('layanans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('statuslay', '=', '1')
                ->get();
        } else {
            $cari = Layanan::orderBy('nama_lay', 'asc')
                ->select('layanans.*')
                ->where('id_mitra', '=', $mitra)
                ->where('statuslay', '=', '1')
                ->where('nama_lay', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $suppli) {
            $response[] = array("value" => $suppli->nama_lay, "id_layanan" => $suppli->id_layanan, "layanan" => $suppli->nama, "harga" => $suppli->harga, "bandwidth" => $suppli->bandwidth);
        }

        return response()->json($response);
    }


    //View Data Barang Untuk Dipinjam
    public function laypel(Request $request)
    {

        $lastRecord = DB::table('bayars')->orderBy('id_bayar', 'desc')->first();
        $autoIdb = [];
        $nextIdNumber = $lastRecord ? ((int)substr($lastRecord->id_bayar, 3)) + 1 : 1;

        $lastRecord = DB::table('laypels')->orderBy('id_laypel', 'desc')->first();
        $autoIds = [];
        $nextIdNumber = $lastRecord ? ((int)substr($lastRecord->id_laypel, 3)) + 1 : 1;

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

        $today = Carbon::now();  // Membuat objek Carbon untuk mewakili hari ini
        $futureDate = $today->addDays(30);  // Menambahkan 30 hari ke tanggal saat ini

        $formattedFutureDate = $futureDate->format('Y-m-d');

        if ($request->nomor == null) {
            //Gagal
            // dd($request);
        } else {
            $count = count($request->nomor);
            for ($i = 0; $i < $count; $i++) {

                $newIdNumber = $nextIdNumber + $i; // Menambahkan $i untuk memastikan nomor unik
                $newId = sprintf("LY-%05s", $newIdNumber);
                $autoIds[] = $newId;

                $newIdNumber = $nextIdNumber + $i; // Menambahkan $i untuk memastikan nomor unik
                $newId = sprintf("BY-%05s", $newIdNumber);
                $autoIdb[] = $newId;

                //Berhasil
                $lay = new Laypel;
                $lay->id_laypel = $autoIds[$i];
                $lay->id_transaksi = ("TR-" . $kds);
                $lay->id_pelanggan = $request->id_pelanggan[$i];
                $lay->id_layanan = $request->id_layanan[$i];
                $lay->harga = $request->harga[$i];
                $lay->pajak = $request->pajak[$i];
                $lay->subtotal = $request->subtotal[$i];
                $lay->statuslaypel = 1;
                // dd($lay);
                $lay->save();

                //Bayar
                $bayar = new Bayar;
                $bayar->id_bayar = $autoIdb[$i];
                $bayar->id_laypel = $autoIds[$i];
                $bayar->tanggal_bayar = $formattedFutureDate;
                $bayar->tanggal_telat = $formattedFutureDate;
                $bayar->total = $request->subtotal[$i];
                $bayar->statusbayar = 1;
                //dd($bayar);
                $bayar->save();
            }

            //transaksi
            $transaksi = new Transaksi;
            $transaksi->id_transaksi = ("TR-" . $kds);
            $transaksi->id_mitra = Auth::guard('mitra')->user()->id_mitra;
            $transaksi->tanggal = $request->tanggal;
            $transaksi->total = $request->total;
            $transaksi->statustrans = 1;
            // dd($transaksi);
            $transaksi->save();

            //dd($lay, $bayar, $transaksi);
            //View Alert
            return redirect()->route('mitra.pelanggan.aktif')->with('alert', 'Layanan Berhasil Ditambahkan');
        }

        return view('Laypel.index');
    }

    //Edit Laypel
    public function editlaypel(Request $request, $id_laypel)
    {
        dd($request->all());
        $laypel = Bayar::where('id_bayar', '=', $request->ids)->first();
        $laypel->total = $request->subtotal;
        //$laypel->save();

        $laypel = Laypel::find($id_laypel);
        $laypel->id_layanan = $request->id_layanan1;
        $laypel->harga = $request->harga;
        $laypel->pajak = $request->pajaknilai;
        $laypel->subtotal = $request->subtotal;
        dd($laypel);
        //$laypel->save();

        //View Alert
        return redirect('/mitra/laypel')->with('alert', 'Layanan Berhasil Diubah');
    }

    //View Transaksi
    public function trans()
    {

        if (Auth::guard('mitra')->check()) {

            $mitra = Auth::guard('mitra')->user()->id_mitra;

            $transaksi = Transaksi::where('id_mitra', $mitra)->get();
            return view('Laypel.transaksi', ['transaksi' => $transaksi, 'mitra' => $mitra]);
        } elseif (Auth::guard('admin')->check() || Auth::guard('staff')->check()) {

            $transaksi = Transaksi::get();
            return view('Laypel.transaksi', ['transaksi' => $transaksi]);
        }
    }

    //Detail Layanan Transaksi
    public function detailtrans($id_transaksi)
    {
        $detail = new Transaksi();
        $detail = $detail->where('id_transaksi', $id_transaksi)->first();
        $detail2 = new Laypel();
        $detaillayanan = $detail2->where('id_transaksi', $id_transaksi)->join('layanans', 'laypels.id_layanan', '=', 'layanans.id_layanan')->get();
        $detailpelanggan = $detail2->where('id_transaksi', $id_transaksi)->join('pelanggans', 'laypels.id_pelanggan', '=', 'pelanggans.id_pelanggan')
            ->join('mitras', 'pelanggans.id_mitra', '=', 'mitras.id_mitra')->select('pelanggans.*', 'mitras.nama as nama_mitra')
            ->first();

        return view('Laypel.detailtrans', compact('detail', 'detaillayanan', 'detailpelanggan'));
    }

    //Detail Layanan Pelanggan
    public function detail($id_laypel)
    {
        $detail = new Laypel();
        $detail = $detail->where('id_laypel', $id_laypel)->first();
        $detaillayanan = $detail->where('id_laypel', $id_laypel)->join('layanans', 'laypels.id_layanan', '=', 'layanans.id_layanan')->get();
        $detailpelanggan = $detail->where('id_laypel', $id_laypel)->join('pelanggans', 'laypels.id_pelanggan', '=', 'pelanggans.id_pelanggan')
            ->join('mitras', 'pelanggans.id_mitra', '=', 'mitras.id_mitra')->select('pelanggans.*', 'mitras.nama as nama_mitra')
            ->first();

        return view('Laypel.detail', compact('detail', 'detaillayanan', 'detailpelanggan'));
    }
}
