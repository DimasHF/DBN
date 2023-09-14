<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPinjam;
use App\Models\Mitra;
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

        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $mitra = Mitra::where('id_mitra', $mitra)->first();
        return view('Pinjaman.checkout', ['pinjam' => $pinjam, 'mitra' => $mitra]);
    }

    //Search Barang
    public function search(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $cari = DB::table('barangs')->orderBy('nama_bar', 'asc')
                ->select('id_barang', 'nama_bar', 'stok', 'statusbar')
                ->where('statusbar', '=', '1')
                ->get();
        } else {
            $cari = DB::table('barangs')->orderBy('nama_bar', 'asc')
                ->select('id_barang', 'nama_bar', 'stok', 'statusbar')
                ->where('statusbar', '=', '1')
                ->where('nama_bar', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $suppli) {
            $response[] = array("value" => $suppli->nama_bar, "label1" => $suppli->id_barang, "label2" => $suppli->stok, "status" => $suppli->statusbar);
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
            $pinjam->statuspinj = '0';
            //dd($pinjam);
            $pinjam->save();
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    //View Pinjaman
    public function list()
    {
        if (Auth::guard('mitra')->check()) {
            $mitra = Auth::guard('mitra')->user()->id_mitra;
            $pinjaman = Pinjaman::where('id_mitra', $mitra)->get();

            return view('Pinjaman.daftar', ['pinjaman' => $pinjaman]);
        } else {
            $pinjaman = Pinjaman::all();
            return view('Pinjaman.daftar', ['pinjaman' => $pinjaman]);
        }
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
        $pinjaman->statuspinj = 1;
        $pinjaman->save();

        $stok = DetailPinjam::where('id_pinjaman', $id_pinjaman)->get();
        $barang = $stok->join('barangs', 'barangs.id_barang', '=', 'detail_pinjams.id_barang')->get();
        foreach ($barang as $b) {
            $barang = Barang::where('id_barang', $b->id_barang)->first();
            $barang->stok = ((float)($barang->stok)) + ((float)($b->jumlah));
            $barang->save();
        }

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function kembali()
    {
        $pinjaman = Pinjaman::where('status', 1)->get();
        return view('Pinjaman.kembali', ['pinjaman' => $pinjaman]);
    }

    public function keranjang($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $cart = session()->get('cart', []);

        if (isset($cart[$id_barang])) {
            $cart[$id_barang]['jumlah']++;
        } else {
            $cart[$id_barang] = [
                'id_barang' => $barang->id_barang,
                'nama_bar' => $barang->nama_bar,
                'harga' => $barang->harga,
                'jumlah' => 1
            ];
        }

        // dd($cart);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Berhasil Ditambahkan Ke Keranjang.');
    }

    public function batal()
    {
        session()->get('cart');

        session()->forget("cart");
        return redirect()->back()->with('error', 'Berhasil Membatalkan Pesanan');
    }

    public function checkout(Request $request)
    {

        //dd($request);
        $mitra = Auth::guard('mitra')->user()->id_mitra;

        //id
        $autoId = DB::table('pinjamen')->select(DB::raw('MAX(RIGHT(id_pinjaman,2)) as autoId'));
        $kds = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kds = sprintf("%02s", $tmp);
            }
        } else {
            $kds = "01";
        }

        $cart = session()->get('cart');

        foreach ($cart as $key => $value) {
            $pesanan = DetailPinjam::create([
                'id_pinjaman' => ("PS-" . date("dmy") . $kds),
                'id_barang' => $value['id_barang'],
                'harga' => $value['harga'],
                'jumlah' => $value['jumlah'],
                'subtotal' => $value['jumlah'] * $value['harga'],
            ]);

            $find = $value['id_barang'];
            $barang = Barang::where('id_barang', $find)->first();
            $jumlahin = ((float)($barang->stok)) - ((float)($pesanan->jumlah));
            $barang->stok = $jumlahin;
            $barang->save();
        }

        $pesanan = new Pinjaman();
        $pesanan->id_pinjaman = ("PS-" . date("dmy") . $kds);
        $pesanan->id_mitra = $mitra;
        $pesanan->tanggal = date("Y-m-d");
        $pesanan->tenggat = $request->tenggat;
        $pesanan->total = $request->total;
        $pesanan->sisa = $request->total;
        $pesanan->statuspinj = 0;
        // dd($pesanan);
        $pesanan->save();

        session()->forget("cart");
        return redirect('/mitra')->with('success', 'Berhasil Melakukan Checkout');
    }

    public function modal($id_peminjaman)
    {
        $pinjam = Pinjaman::find($id_peminjaman);

        return response()->json([
            'status' => 200,
            'pinjam' => $pinjam
        ]);
    }

    public function bayar(Request $request)
    {
        //dd(request()->all());
        $pinjam = Pinjaman::where('id_pinjaman', $request->id_pinjaman)->first();
        $pinjam->sisa = $request->sisa - $request->bayarform;
        $pinjam->save();

        if($pinjam->sisa == 0){
            $pinjam->statuspinj = 1;
            $pinjam->save();
        }

        return redirect()->back()->with('success', 'Berhasil Melakukan Pembayaran');
    }
}
