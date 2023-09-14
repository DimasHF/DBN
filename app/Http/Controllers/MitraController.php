<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Mitra;
use App\Models\Pelanggan;
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
        $pelanggan = Pelanggan::all()->count();
        $layanan = Layanan::all()->count();

        return view('Mitra.index', ['mitra' => $mitra, 'pelanggan' => $pelanggan, 'layanan' => $layanan]);
    }

    public function test()
    {

        $bulanIni = Carbon::now();
        $tanggalMendaftar = 5;
        $total = 5000;
        
        if ($tanggalMendaftar == 1) {
            $jumlahHariDalamBulanIni = $bulanIni->daysInMonth;
            $perhari = $total / $jumlahHariDalamBulanIni;
            $bayar = $total;
        } else {

            $tanggalSaatIni = $bulanIni->day;
            $hariTerakhirDiBulanIni = $bulanIni->endOfMonth()->day;

            $hariTersisa = $hariTerakhirDiBulanIni - $tanggalSaatIni + 1;

            $perhari = $total / $hariTerakhirDiBulanIni;
            $bayar = $perhari * $hariTersisa;
        }

        dump($perhari);
        echo "Jumlah yang harus dibayar: " . $bayar;
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
        $mitra->no_telp = ("62" . $request->no_telp);
        $mitra->statusmitra = 0;
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

        $user = Mitra::where('username', $request->username)->first();

        if ($user && $user->status === 0) {
            return back()->with('error', 'Akun Anda dinonaktifkan. Silakan hubungi administrator.');
        }

        if (Auth::guard('mitra')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/mitra')->with('success', 'Login Berhasil');
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
            $logo = $request->file('logo');
            $maxSize = 3 * 1024 * 1024;
            if ($logo->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file foto terlalu besar. Maksimum 3 MB.');
            }
            $filename = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('logo'), $filename);
            $data['logo'] = $filename;
        }

        $data['no_telp'] = '62' . $request->no_telp;

        Mitra::where('id_mitra', $id_mitra)->update($data);

        return redirect('/mitra/profil')->with('success', 'Data Berhasil Diubah');
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
            $tanggal = $today->day; 
            $bulan = $today->monthName;   
            $tahun = $today->year;  
            $jamSekarang = $today->format('H:i:s'); 
            return view('Dokumen.spk', ['po' => $po, 'day' => $day, 'tanggal' => $tanggal, 'bulan' => $bulan, 'tahun' => $tahun, 'jamSekarang' => $jamSekarang]);
        }

        $today = Carbon::now();

        $day = $today->dayName;
        $tanggal = $today->day; 
        $bulan = $today->monthName;   
        $tahun = $today->year;  
        $jamSekarang = $today->format('H:i:s'); 

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
