<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    //View Pelanggan
    public function index()
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;

        if (Auth::guard('mitra')->check()) {

            $pelanggan = Pelanggan::where('id_mitra', $mitra)->where('status', '=', '1')->get();
        } elseif (Auth::guard('admin')->check() || Auth::guard('staff')->check()) {

            $pelanggan = Pelanggan::get();
        }

        $autoId = DB::table('pelanggans')->select(DB::raw('MAX(RIGHT(id_pelanggan,5)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "00001";
        }

        return view('Pelanggan.index', ['pelanggan' => $pelanggan, 'kd' => $kd, 'mitra' => $mitra]);
    }

    //Form Add
    public function formadd(){
        return view('Pelanggan.tambah');
    }

    //Add Pelanggan
    public function add(Request $request)
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;

        $autoId = DB::table('pelanggans')->select(DB::raw('MAX(RIGHT(id_pelanggan,5)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "00001";
        }

        $pel = new Pelanggan;
        $pel->id_pelanggan = 'PEL' . date('Y-m-d') . $kd;
        $pel->id_mitra = $mitra;
        $pel->nama = $request->nama;
        $pel->alamat = $request->alamat;
        $pel->no_telp = $request->no_telp;
        $pel->email = $request->email;
        $pel->nik = $request->nik;
        $pel->npwp = $request->npwp;
        $pel->status = $request->status;
        $pel->save();

        //dd($pel);

        //View Alert
        return redirect('/mitra/pelanggan')->with('alert', 'Produk Baru Berhasil Ditambahkan');
    }

    //View Data Pelanggan Semua Mitra
    public function pelanggan($id_mitra)
    {
        $pelanggan = Pelanggan::where('id_mitra', $id_mitra)->get();

        return view('Pelanggan.mitra', ['pelanggan' => $pelanggan]);
    }

    //View Data Detail Pelanggan Setiap Mitra
    public function detail($id_pelanggan)
    {
        $pelanggan = Pelanggan::whereIdPelanggan($id_pelanggan);
        return view('Pelanggan.detail', ['pelanggan' => $pelanggan]);
    }

    //View Edit
    public function show($id_pelanggan)
    {
        $pelanggan = Pelanggan::find($id_pelanggan);
        return response()->json($pelanggan);
    }

    //Edit Pelanggan
    public function edit(Request $request)
    {
        //Update
        Pelanggan::updateOrCreate(
            ['id_pelanggan' => $request->id_pelanggan],
            ['id_layanan' => $request->id_layanan, 'nama' => $request->nama, 'alamat' => $request->alamat, 'no_telp' => $request->no_telp, 'email' => $request->email, 'nik' => $request->nik, 'npwp' => $request->npwp]
        );

        return response()->json(['success' => true, 'message' => 'Data Pelanggan Diubah'], 200);
    }

    //Status Pelanggan
    public function status($status, $id_pelanggan)
    {
        $model = Pelanggan::findOrFail($id_pelanggan);
        $model->status = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }
}
