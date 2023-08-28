<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

        //Create Table
        $mitra = new Mitra;
        $mitra->id_mitra = ("MIT" . $kd);
        $mitra->nama = $request->nama;
        $mitra->username = $request->username;
        $mitra->password = bcrypt($request->password);
        $mitra->email = $request->email;
        $mitra->no_telp = ("62".$request->no_telp);
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

        $mitra = Mitra::where('id_mitra', $mitra)->select('*')->first();

        return view('Mitra.detail', ['mitra' => $mitra]);
    }

    //View Edit Data Profil Mitra
    public function edit($id_mitra)
    {
        $mitra = Mitra::where('id_mitra', $id_mitra)->select('*')->first();

        return view('Mitra.edit', ['mitra' => $mitra]);
    }

    //Update Data Profil Mitra
    public function update(Request $request, $id_mitra)
    {
        //dd($request);

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('logo')) {
            // Get the uploaded image
            $logo = $request->file('logo');
            // Generate a unique file name for the logo
            $filename = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            // Move the uploaded logo to the desired location
            $logo->move(public_path('logo'), $filename);
            $data['logo'] = $filename;

        }

        $data['notelp'] = '62' . $request->notelp;

        Mitra::where('id_mitra', $id_mitra)->update($data);

        return redirect('/mitra/profil')->with('alert', 'Data Berhasil Diubah');
    }

    //View SPK Mitra
    public function spk()
    {
        if (Auth::guard('mitra')->check()) {
            $mitra = Auth::guard('mitra')->user()->id_mitra;

            $po = DB::table('purchase_orders')
                ->join('mitras', 'purchase_orders.id_mitra', '=', 'mitras.id_mitra')
                ->select('purchase_orders.*', 'mitras.nama')
                ->where('purchase_orders.id_mitra', $mitra)
                ->first();

            $today = Carbon::now();

            $day = $today->dayName;
            $tanggal = $today->day; // Tanggal (hari)
            $bulan = $today->monthName;   // Bulan
            $tahun = $today->year;  // Tahun
            $jamSekarang = $today->format('H:i:s'); // Jam
            return view('Dokumen.spk', ['po' => $po, 'day' => $day, 'tanggal' => $tanggal, 'bulan' => $bulan, 'tahun' => $tahun, 'jamSekarang' => $jamSekarang]);
        }

        $today = Carbon::now();

        $day = $today->dayName;
        $tanggal = $today->day; // Tanggal (hari)
        $bulan = $today->monthName;   // Bulan
        $tahun = $today->year;  // Tahun
        $jamSekarang = $today->format('H:i:s'); // Jam

        return view('Dokumen.spk', ['day' => $day, 'tanggal' => $tanggal, 'bulan' => $bulan, 'tahun' => $tahun, 'jamSekarang' => $jamSekarang]);
    }

    //View Map Mitra
    public function map()
    {
        $mitra1 = Auth::guard('mitra')->user()->id_mitra;
        $mitra = Mitra::find($mitra1);
        return view('Mitra.map', ['mitra' => $mitra]);
    }
}
