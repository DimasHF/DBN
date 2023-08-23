<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    //View Layanan
    public function index()
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $layanan = Layanan::where('id_mitra', '=', $mitra)->orderBy('nama', 'asc')->get();

        return view('Layanan.index', ['layanan' => $layanan]);
    }

    //Form Add
    public function formadd()
    {
        return view('Layanan.tambah');
    }

    //Tambah Layanan
    public function add(Request $request)
    {
        $autoId = DB::table('layanans')->select(DB::raw('MAX(RIGHT(id_layanan,3)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }

        $mitra = Auth::guard('mitra')->user()->id_mitra;

        $layanan = new Layanan;
        $layanan->id_layanan = ('LY' . $kd);
        $layanan->id_mitra = $mitra;
        $layanan->nama = $request->nama;
        $layanan->harga = $request->harga;
        $layanan->bandwidth = $request->bandwidth;
        $layanan->status = 1;
        $layanan->save();

        //View Alert
        return redirect()->route('mitra.layanan')->with('alert', 'Layanan Berhasil Ditambahkan');
    }

    //View Edit
    public function show($id_layanan)
    {
        $layanan = Layanan::find($id_layanan);
        return response()->json($layanan);
    }

    //Edit Layanan
    public function edit(Request $request)
    {
        //Update
        Layanan::updateOrCreate(
            ['id_layanan' => $request->id_layanan],
            ['nama' => $request->nama, 'harga' => $request->harga, 'badwidth' => $request->badwidth]
        );

        return response()->json(['success' => true, 'message' => 'Data Layanan Diubah'], 200);
    }

    //Status Layanan
    public function status($status, $id_layanan)
    {
        $model = Layanan::findOrFail($id_layanan);
        $model->status = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }
}
