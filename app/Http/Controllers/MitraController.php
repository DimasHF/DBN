<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{

    //View Dashboard Mitra
    public function index()
    {
        $mitra = Auth::guard('mitra')->check();

        return view('Mitra.index', ['mitra' => $mitra]);
    }

    //View Register Mitra
    public function register()
    {

        return view('Mitra.registrasi');
    }

    //Register Mitra
    public function regmitra(Request $request)
    {
        $autoId = DB::table('mitras')->select(DB::raw('MAX(RIGHT(id_mitra,4)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        //dd($request);

        // Get the uploaded image
        $logo = $request->file('logo');

        // Generate a unique file name for the logo
        $filename = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();

        // Move the uploaded logo to the desired location
        $logo->move(('logo'), $filename);

        //Create Table
        $mitra = new Mitra;
        $mitra->id_mitra = ("MIT".$kd);
        $mitra->nama = $request->nama;
        $mitra->username = $request->username;
        $mitra->password = bcrypt($request->password);
        $mitra->email = $request->email;
        $mitra->no_telp = $request->no_telp;
        $mitra->nik = $request->nik;
        $mitra->npwp = $request->npwp;
        $mitra->alamat = $request->alamat;
        $mitra->koordinat = $request->koordinat;
        $mitra->logo = 'logo/' . $filename;
        $mitra->status = 0;
        $mitra->save();

        // dd($request);
        //Return Views
        return redirect('/mitra/login')->with('alert', 'Akun Mitra Berhasil Dibuat');
    }

    //View login Mitra
    public function logview()
    {
        return view('Mitra.login');
    }

    //Login Mitra
    public function login(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('mitra')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/mitra')->with('alert', 'Login Berhasil');
        }

        return back()->with('alert', 'Login Gagal');
    }

    //Logout Mitra
    public function logout(Request $request)
    {
        Auth::guard('mitra')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/mitra/login')->with('alert', 'Logout Berhasil');
    }

    //View Data Profil Mitra
    public function profil()
    {
        $mitra = Auth::guard('mitra')->user()->id_mitra;

        $mitra = Mitra::where('id_mitra', $mitra)->first();

        return view('Mitra.detail', ['mitra' => $mitra]);
    }

    //Update Data Profil Mitra
    public function update(Request $request, $id_mitra)
    {
        $model = Mitra::findOrFail($id_mitra);
        $model->nama = $request->nama;
        $model->username = $request->username;
        $model->password = bcrypt($request->password);
        $model->email = $request->email;
        $model->no_telp = $request->no_telp;
        $model->nik = $request->nik;
        $model->npwp = $request->npwp;
        $model->alamat = $request->alamat;
        $model->koordinat = $request->koordinat;
        $model->logo = $request->logo;
        $model->status = $request->status;

        $model->save();

        return redirect('/mitra/profil')->with('alert', 'Data Berhasil Diubah');
    }
}
