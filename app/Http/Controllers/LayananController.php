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
        if (Auth::guard('admin')->check() || Auth::guard('staff')->check() || Auth::user()) {

            $layanan = Layanan::orderBy('id_mitra', 'asc')->get();
            return view('Layanan.index', ['layanan' => $layanan]);
        } else {
            $mitra = Auth::guard('mitra')->user()->id_mitra;
            $layanan = Layanan::where('id_mitra', '=', $mitra)->orderBy('nama_lay', 'asc')->get();

            return view('Layanan.index', ['layanan' => $layanan]);
        }
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
        $layanan->nama_lay = $request->nama_lay;
        $layanan->harga = $request->harga;
        $layanan->bandwidth = $request->bandwidth;
        $layanan->statuslay = 1;
        $layanan->save();

        //View Alert
        return redirect()->route('mitra.layanan')->with('alert', 'Layanan Berhasil Ditambahkan');
    }

    //View Edit
    public function show($id_layanan)
    {
        $layanan = Layanan::where('id_layanan', $id_layanan)->first();
        return view('Layanan.edit', ['layanan' => $layanan]);
        // return response()->json($layanan);

    }

    //Edit Layanan
    public function edit(Request $request, $id_layanan)
    {
        //Update
        Layanan::where('id_layanan', $id_layanan)->update([
            'nama_lay' => $request->nama_lay,
            'harga' => $request->harga,
            'bandwidth' => $request->bandwidth,
        ]);

        //View Alert
        return redirect()->route('mitra.layanan')->with('alert', 'Layanan Berhasil Diperbarui');
        // return response()->json(['success' => true, 'alert' => 'Data Tanaman Diubah'], 200);

    }

    //Status Layanan
    public function status($status, $id_layanan)
    {
        $model = Layanan::findOrFail($id_layanan);
        $model->statuslay = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }

}
