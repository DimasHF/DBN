<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    public function pinjaman()
    {

        if (Auth::guard('mitra')->check()) {
            $mitra = auth()->guard('mitra')->user()->id_mitra;
            $pinjaman = Pinjaman::where('id_mitra', $mitra)->where('status', 1)->get();
            return view('Rekap.pinjaman', ['pinjaman' => $pinjaman, 'mitra' => $mitra]);
        } else {
            $pinjaman = Pinjaman::where('status', 1)->get();
            return view('Rekap.pinjaman', ['pinjaman' => $pinjaman]);
        }
    }
}
