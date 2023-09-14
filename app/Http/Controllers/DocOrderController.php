<?php

namespace App\Http\Controllers;

use App\Models\DocOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocOrderController extends Controller
{
    //
    public function send(Request $request)
    {
        //dd($request->all());
        $data = $request->except(['_token', '_method']);

        $allowedFields = ['ktp', 'npwp', 'form', 'akta', 'izp'];

        foreach ($allowedFields as $fieldName) {
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $maxSize = 5 * 1024 * 1024;

                if ($file->getSize() > $maxSize) {
                    return redirect()->back()->with('error', 'Ukuran file ' . $fieldName . ' terlalu besar. Maksimum 5 MB.');
                }

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($fieldName), $filename);
                $data[$fieldName] = $filename;
            }
        }

        DocOrder::create($data);

        return redirect()->back()->with('success', 'Dokumen Berhasil Diunggah. Silahkan Tunggu Konfirmasi Lebih Lanjut');
    }

    public function list()
    {
        $doc = DocOrder::join('orders', 'doc_orders.id_order', '=', 'orders.id_order')
            ->join('mitras', 'orders.id_mitra', '=', 'mitras.id_mitra')
            ->select('doc_orders.*', 'mitras.nama', 'orders.id_order')
            ->get();

        return view('Order.docorder', ['doc' => $doc]);
    }

    public function downloadktp($id_order)
    {
        $mitra = DocOrder::join('orders', 'doc_orders.id_order', '=', 'orders.id_order')
            ->where('doc_orders.id_order', $id_order)
            ->first();

        $doc = DocOrder::where('id_order', $id_order)->first();
        $file = public_path('/ktp/' . $doc->ktp);

        if ($mitra && isset($mitra->id_order)) {
            $customFilename = $mitra->id_order . '_' . 'ktp' . '.' . pathinfo($file, PATHINFO_EXTENSION);
        } else {
            $customFilename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
        }

        return response()->download($file, $customFilename);
    }

    public function downloadnpwp($id_order)
    {
        $mitra = DocOrder::join('orders', 'doc_orders.id_order', '=', 'orders.id_order')
            ->where('doc_orders.id_order', $id_order)
            ->first();

        $doc = DocOrder::where('id_order', $id_order)->first();
        $file = public_path('/npwp/' . $doc->npwp);

        if ($mitra && isset($mitra->id_order)) {
            $customFilename = $mitra->id_order . '_' . 'npwp' . '.' . pathinfo($file, PATHINFO_EXTENSION);
        } else {
            $customFilename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
        }

        return response()->download($file, $customFilename);
    }

    public function downloadform($id_order)
    {
        $mitra = DocOrder::join('orders', 'doc_orders.id_order', '=', 'orders.id_order')
            ->where('doc_orders.id_order', $id_order)
            ->first();

        $doc = DocOrder::where('id_order', $id_order)->first();
        $file = public_path('/form/' . $doc->form);

        if ($mitra && isset($mitra->id_order)) {
            $customFilename = $mitra->id_order . '_' . 'form' . '.' . pathinfo($file, PATHINFO_EXTENSION);
        } else {
            $customFilename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
        }

        return response()->download($file, $customFilename);
    }

    public function downloadakta($id_order)
    {
        $mitra = DocOrder::join('orders', 'doc_orders.id_order', '=', 'orders.id_order')
            ->where('doc_orders.id_order', $id_order)
            ->first();

        $doc = DocOrder::where('id_order', $id_order)->first();
        $file = public_path('/akta/' . $doc->akta);
        if ($mitra && isset($mitra->id_order)) {
            $customFilename = $mitra->id_order . '_' . 'akta' . '.' . pathinfo($file, PATHINFO_EXTENSION);
        } else {
            $customFilename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
        }

        return response()->download($file, $customFilename);
    }

    public function downloadizp($id_order)
    {
        $mitra = DocOrder::join('orders', 'doc_orders.id_order', '=', 'orders.id_order')
            ->where('doc_orders.id_order', $id_order)
            ->first();

        $doc = DocOrder::where('id_order', $id_order)->first();
        $file = public_path('/izp/' . $doc->izp);
        if ($mitra && isset($mitra->id_order)) {
            $customFilename = $mitra->id_order . '_' . 'izp' . '.' . pathinfo($file, PATHINFO_EXTENSION);
        } else {
            $customFilename = pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION);
        }

        return response()->download($file, $customFilename);
    }
}
