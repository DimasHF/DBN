<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    //View Purchase Order Mitra
    public function po()
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        return view('Purchase.purchaseorder', ['mitra' => $mitra]);
    }

    //Proses Purchase Order Mitra
    public function proses(Request $request)
    {
        $autoId = DB::table('purchase_orders')->select(DB::raw('MAX(RIGHT(id_purchase_order,4)) as autoId'));
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

        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'id_purchase_order' => 'required|unique',
            'tanggal' => 'required',
            'spk' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'ba' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Jika validasi berhasil
        $po = new PurchaseOrder;
        $po->id_purchase_order = 'PO' . $kd;
        $po->id_mitra = $user;
        $po->tanggal = $request->tanggal;
        $po->status = 0;

        if ($request->hasFile('spk')) {
            $spk = $request->file('spk');
            $filename = Str::uuid() . '_' . $spk->getClientOriginalName();
            $spk->storeAs('spks', $filename, 'public');
            $po->spk = $filename;
        }

        if ($request->hasFile('ba')) {
            $ba = $request->file('ba');
            $filename = Str::uuid() . '_' . $ba->getClientOriginalName();
            $ba->storeAs('bas', $filename, 'public');
            $po->ba = $filename;
        }

        $po->save();

        return response()->json(['success' => true, 'message' => 'Purchase Order Baru Telah Diajukan'], 200);
    }
}
