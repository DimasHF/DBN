<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mitra;
use App\Models\Pelanggan;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    //View Login Admin
    public function index()
    {
        $admin = Auth::guard('admin')->check();

        $mitra = Mitra::where('status', 0)->paginate(10);

        $jumlahmitra = Mitra::where('status', 1)->count();
        $jumlahpelanggan = Pelanggan::where('status', 1)->count();

        return view('Admin.index', ['admin' => $admin, 'mitra' => $mitra, 'jumlahmitra' => $jumlahmitra, 'jumlahpelanggan' => $jumlahpelanggan]);
    }

    //View Register Admin
    public function register()
    {
        $autoId = DB::table('admins')->select(DB::raw('MAX(RIGHT(id_admin,2)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%02s", $tmp);
            }
        } else {
            $kd = "01";
        }

        return view('Admin.registrasi', ['kd' => $kd]);
    }

    //Register Admin
    public function regadmin(Request $request)
    {
        $autoId = DB::table('admins')->select(DB::raw('MAX(RIGHT(id_admin,2)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%02s", $tmp);
            }
        } else {
            $kd = "01";
        }

        //Create Table
        Admin::create([
            'id_admin' => ('A' . $kd),
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'status' => 1,
        ]);

        return redirect('/admin/login')->with('alert', 'Registrasi Berhasil');
    }

    //View Login Admin
    public function logview()
    {
        return view('Admin.login');
    }

    //Login Admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->with('alert', 'Login Gagal');
    }

    //Logout Admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('alert', 'Logout Berhasil');
    }

    //View Data Mitra
    public function mitra()
    {
        $mitra = Mitra::all();

        return view('Mitra.list', ['mitra' => $mitra]);
    }

    //Konfirmasi Mitra
    public function konfirmasi($status, $id_mitra)
    {
        $model = Mitra::findOrFail($id_mitra);
        $model->status = $status;

        //dd($model);

        $apikey = "c334dfca6ce6e04338dc0a34f833ab10dea42f87";
        $tujuan = $model->no_telp; //atau $tujuan="Group Chat Name";
        $pesan = "Akun Mitra Anda Telah Disetujui. Silahkan Login Untuk Melakukan Proses Purchase Order";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://starsender.online/api/sendText?message='.rawurlencode($pesan).'&tujuan='.rawurlencode($tujuan.'@s.whatsapp.net'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'apikey: '.$apikey
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;

        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }

        return redirect()->back()->with($notice);
    }

    //Konfirmasi Mitra
    public function aktif($status, $id_purchase_order)
    {
        $model = PurchaseOrder::findOrFail($id_purchase_order);
        $model->status = $status;

        //$model->dd();
        $mitra = Mitra::where('id_mitra', $model->id_mitra)->first();

        $apikey = "c334dfca6ce6e04338dc0a34f833ab10dea42f87";
        $tujuan = $mitra->no_telp; //atau $tujuan="Group Chat Name";
        $pesan = "Purchase Order Anda Telah Disetujui. Sekarang Anda Menjadi Mitra Kami";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://starsender.online/api/sendText?message='.rawurlencode($pesan).'&tujuan='.rawurlencode($tujuan.'@s.whatsapp.net'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => array(
            'apikey: '.$apikey
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;

        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }


        return redirect()->back()->with($notice);
    }

    //View Data Detail Mitra
    public function detail($id_mitra)
    {
        $mitra = Mitra::where('id_mitra', $id_mitra)->first();
        return view('Mitra.detail', ['mitra' => $mitra]);
    }
}
