<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{

    //View Login Staff
    public function index()
    {
        $staff = Auth::guard('staff')->check();

        return view('Staff.index', ['staff' => $staff]);
    }

    //View Register Staff
    public function register()
    {
        return view('Staff.registrasi');
    }

    //Register Staff
    public function regstaff(Request $request)
    {
        $autoId = DB::table('staff')->select(DB::raw('MAX(RIGHT(id_staff,2)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "01";
        }

        //Create Table
        $staff = new Staff;
        $staff->id_staff = ("ST" . $kd);
        $staff->nama = $request->nama;
        $staff->username = $request->username;
        $staff->password = bcrypt($request->password);
        $staff->email = $request->email;
        $staff->no_telp = ("62" . $request->no_telp);
        $staff->statusstaff = 0;
        $staff->save();

        return redirect('/staff/login')->with('alert', 'Registrasi Berhasil');
    }

    //View Login Staff
    public function logview()
    {
        return view('Staff.login');
    }

    //Login Staff
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('staff')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/staff')->with('success', 'Login Berhasil');
        }

        return back()->with('alert', 'Login Gagal');
    }

    //Logout Staff
    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/staff/login')->with('alert', 'Logout Berhasil');
    }

    //View Data Mitra
    public function mitra()
    {
        $mitra = Mitra::select('id_mitra', 'nama', 'logo', 'statusmitra')->get();

        return view('Staff.mitra', ['mitra' => $mitra]);
    }

    //View Data Detail Mitra
    public function detail($id)
    {
        $mitra = Mitra::find($id);

        return view('Staff.detail', ['mitra' => $mitra]);
    }

}
