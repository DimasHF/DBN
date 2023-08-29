<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    //View Barang
    public function index()
    {
        $barang = Barang::all();
        return view('Barang.index', ['barang' => $barang]);
    }

    //Form Add
    public function formadd()
    {
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

        return view('Barang.tambah', ['kd' => $kd]);
    }

    //Tambah Barang
    public function add(Request $request)
    {

        // Get the uploaded image
        $image = $request->file('foto');

        // Generate a unique file name for the image
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Move the uploaded image to the desired location
        $image->move(('barang'), $filename);

        //Save
        $barang = new Barang;
        $barang->id_barang = $request->id_barang;
        $barang->nama_bar = $request->nama_bar;
        $barang->stok = $request->stok;
        $barang->status = 1;
        $barang->foto = 'barang/' . $filename;
        $barang->save();

        //View Alert
        return redirect('/admin/barang')->with('alert', 'Barang Baru Berhasil Ditambahkan');
    }

    //View Edit
    public function show($id_barang)
    {
        $barang = Barang::where('id_barang', $id_barang)->first();
        return view('Barang.edit', ['barang' => $barang]);
    }

    //Edit Barang
    public function edit(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('foto')) {
            // Get the uploaded image
            $foto = $request->file('foto');
            // Generate a unique file name for the foto
            $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            // Move the uploaded foto to the desired location
            $foto->move(public_path('foto'), $filename);
            $data['foto'] = $filename;

        }

        Barang::where('id_barang', $request->id_barang)->update($data);

        //View Alert
        return redirect('/admin/barang')->with('alert', 'Barang Berhasil Diperbarui');
    }

    //Status Barang
    public function status($status, $id_barang)
    {
        $model = Barang::findOrFail($id_barang);
        $model->status = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }

    //View Barang Katalog
    public function daftar()
    {
        $barang = Barang::all();
        return view('Barang.daftar', ['barang' => $barang]);
    }
}
