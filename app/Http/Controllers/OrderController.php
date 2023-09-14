<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;
        $mitra = Mitra::where('id_mitra', $mitra)->select('*')->first();

        return view('Order.order', ['mitra' => $mitra]);
    }

    public function map()
    {
        $mitra1 = Auth::guard('mitra')->user()->id_mitra;
        $mitra = Mitra::find($mitra1);
        return view('Order.map', ['mitra' => $mitra]);
    }

    public function store(Request $request)
    {
        $autoId = DB::table('orders')->select(DB::raw('MAX(RIGHT(id_order,3)) as autoId'));
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
        $mitra = Mitra::where('id_mitra', $mitra)->select('*')->first();

        $order = new Order;
        $order->id_order = ("ORD" . $kd);
        $order->id_mitra = $mitra->id_mitra;
        $order->alamat = $request->alamat;
        $order->longitude = $request->longitude;
        $order->latitude = $request->latitude;
        $order->bandwidth = $request->bandwidth;
        $order->harga = $request->harga;
        $order->statusadmin = 0;
        $order->statusmitra = 1;
        $order->terakhir = $mitra->id_mitra;
        $order->statusorder = 0;
        //dd($order);
        $order->save();

        return redirect('/mitra/order')->with('success', 'Data Order Berhasil Diajukan!');
    }

    public function modal($id_order)
    {
        $order = Order::where('id_order', $id_order)->first();
        return response()->json([
            'status' => 200,
            'order' => $order
        ]);
    }

    public function nego(Request $request, $id_order)
    {
        if (Auth::guard('mitra')->check()) {
            $mitra = Auth::guard('mitra')->user()->id_mitra;
            Order::where('id_order', $id_order)->update([
                'harga' => $request->harga,
                'pajak' => $request->pajak,
                'total' => $request->total,
                'statusmitra' => 1,
                'statusadmin' => 0,
                'terakhir' => $mitra,
            ]);
            return redirect('/mitra/order/list')->with('success', 'Data Order Berhasil Diperbarui!');
        } elseif (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user()->id_admin;
            Order::where('id_order', $id_order)->update([
                'harga' => $request->harga,
                'pajak' => $request->pajak,
                'total' => $request->total,
                'statusmitra' => 0,
                'statusadmin' => 1,
                'terakhir' => $admin,
            ]);
            return redirect('/admin/order/list')->with('success', 'Data Order Berhasil Diperbarui!');
        } else {
            $staff = Auth::guard('staff')->user()->id_staff;
            Order::where('id_order', $id_order)->update([
                'harga' => $request->harga,
                'pajak' => $request->pajak,
                'total' => $request->total,
                'statusmitra' => 0,
                'statusadmin' => 1,
                'terakhir' => $staff,
            ]);
            return redirect('/staff/order/list')->with('success', 'Data Order Berhasil Diperbarui!');
        }
        //dd($request->all());
    }

    public function status($id_order)
    {
        if (Auth::guard('mitra')->check()) {
            Order::where('id_order', $id_order)->update([
                'statusmitra' => 2,
            ]);

            return redirect('/mitra/order/list')->with('success', 'Data Order Berhasil Dikonfirmasi!');
        } else {
            Order::where('id_order', $id_order)->update([
                'statusadmin' => 2,
            ]);

            return redirect('/admin/order/list')->with('success', 'Data Order Berhasil Dikonfirmasi!');
        }
    }

    public function cetak($id_order)
    {
        Order::where('id_order', $id_order)->update([
            'statusorder' => 1,
        ]);

        return redirect('/mitra/order/list')->with('success', 'Data Order Berhasil Dikonfirmasi!');
    }

    public function list()
    {
        if (Auth::guard('mitra')->check()) {
            $mitra = Auth::guard('mitra')->user()->id_mitra;
            $mitra = Mitra::where('id_mitra', $mitra)->select('*')->first();
            $order = Order::where('id_mitra', $mitra->id_mitra)->get();
            return view('Order.list', ['order' => $order]);
        } else {
            $order = Order::all();
            return view('Order.list', ['order' => $order]);
        }
    }

    public function detail($id_order)
    {
        $order = Order::where('id_order', $id_order)->first();
        return view('Order.detail', ['order' => $order]);
    }

    public function konfirmasi($id_order)
    {
        $order = Order::find($id_order);

        return response()->json([
            'status' => 200,
            'order' => $order
        ]);
    }

    public function form()
    {
        return view('Dokumen.form');
    }

    public function dokumen()
    {
        $order = Order::where('id_mitra', Auth::guard('mitra')->user()->id_mitra)
            ->where('statusorder', 1)
            ->get();

        return view('Order.send', ['order' => $order]);
    }
}
