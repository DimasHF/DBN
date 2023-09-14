<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

    public function index()
    {
        $barang = Barang::all();

        $autoId = DB::table('barangs')->select(DB::raw('MAX(RIGHT(id_barang,3)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }

        return view('Barang.index', ['barang' => $barang, 'kd' => $kd]);
    }

    // public function formadd()
    // {
    //     $autoId = DB::table('barangs')->select(DB::raw('MAX(RIGHT(id_barang,3)) as autoId'));
    //     $kd = "";
    //     if ($autoId->count() > 0) {
    //         foreach ($autoId->get() as $a) {
    //             $tmp = ((int)$a->autoId) + 1;
    //             $kd = sprintf("%03s", $tmp);
    //         }
    //     } else {
    //         $kd = "001";
    //     }

    //     return view('Barang.tambah', ['kd' => $kd]);
    // }

    public function add(Request $request)
    {
        //dd($request->all());

        $image = $request->file('foto');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(('barang'), $filename);

        //Save
        $barang = new Barang;
        $barang->id_barang = $request->id_barang;
        $barang->nama_bar = $request->nama_bar;
        $barang->stok = $request->stok;
        $barang->harga = $request->harga;
        $barang->deskripsi = $request->deskripsi;
        $barang->statusbar = 1;
        $barang->foto = 'barang/' . $filename;
        $barang->save();

        //View Alert
        return redirect('/admin/barang')->with('success', 'Barang Baru Berhasil Ditambahkan');
    }

    public function show($id_barang)
    {
        $barang = Barang::where('id_barang', $id_barang)->first();
        return view('Barang.edit', ['barang' => $barang]);
    }

    public function edit(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('foto'), $filename);
            $data['foto'] = $filename;
        }

        if (!isset($data['foto'])) {
            unset($data['foto']);
        }

        Barang::where('id_barang', $request->id_barang)->update($data);

        //View Alert
        return redirect('/admin/barang')->with('success', 'Barang Berhasil Diperbarui');
    }

    public function status($status, $id_barang)
    {
        $model = Barang::findOrFail($id_barang);
        $model->statusbar = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['success' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }

    public function daftar()
    {
        $barang = Barang::where('statusbar', 1)->get();
        return view('Barang.daftar', ['barang' => $barang]);
    }

    public function plusproses(Request $request)
    {
        //dd($request->all());
        $barangId = $request->input('idbarang');
        $stokBaru = $request->input('stokplus');

        $barang = Barang::find($barangId);

        if ($barang) {
            // Update stok barang
            $barang->update([
                'stok' => $barang->stok + $stokBaru,
            ]);

            //dd($barang);
            return redirect()->back()->with('success', 'Stok Berhasil Ditambahkan');
        } else {
            // Handle jika barang tidak ditemukan
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }
    }

    public function detail($id_barang)
    {
        $barang = Barang::whereIdBarang($id_barang)->first();
        return view('Barang.detail', ['barang' => $barang]);
    }
}
