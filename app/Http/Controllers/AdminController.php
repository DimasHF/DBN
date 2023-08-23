<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mitra;
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

        return view('Admin.index', ['admin' => $admin]);
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
            'id_admin' => 'A'.$kd,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'status' => 1,
        ]);

        return redirect('/admin')->with('alert', 'Registrasi Berhasil');
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
 
            return redirect()->intended('/');
        }
 
        return back()->with('alert', 'Login Gagal');
    }

    //Logout Admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('alert', 'Logout Berhasil');
    }

    //View Data Mitra
    public function mitra()
    {
        $mitra = Mitra::all();

        return view('Admin.mitra', ['mitra' => $mitra]);
    }

    //Konfirmasi Mitra
    public function konfirmasi($status, $id_mitra)
    {
        $model = Mitra::findOrFail($id_mitra);
        $model->status = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }

    //View Data Detail Mitra
    public function detail($id_mitra)
    {
        $mitra = Mitra::find($id_mitra);
        return response()->json($mitra);
    }
    
}
