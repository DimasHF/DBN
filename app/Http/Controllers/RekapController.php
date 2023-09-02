<?php

namespace App\Http\Controllers;

use App\Exports\ExportTagihan;
use App\Models\Laypel;
use App\Models\Pinjaman;
use App\Models\Rekap;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RekapController extends Controller
{
    public function pinjaman()
    {

        if (Auth::guard('mitra')->check()) {
            $mitra = auth()->guard('mitra')->user()->id_mitra;
            $pinjaman = Pinjaman::where('id_mitra', $mitra)->where('statuspinj', 1)->get();
            return view('Rekap.pinjaman', ['pinjaman' => $pinjaman, 'mitra' => $mitra]);
        } else {
            $pinjaman = Pinjaman::where('statuspinj', 1)->get();
            return view('Rekap.pinjaman', ['pinjaman' => $pinjaman]);
        }
    }

    public function tagihan()
    {

        if (Auth::guard('mitra')->check()) {
            $mitra = auth()->guard('mitra')->user()->id_mitra;
            $tagihan = Tagihan::join('laypels', 'laypels.id_laypel', '=', 'tagihans.id_laypel')
                ->join('layanans', 'layanans.id_layanan', '=', 'laypels.id_layanan')
                ->join('mitras', 'mitras.id_mitra', '=', 'layanans.id_mitra')
                ->where('mitras.id_mitra', $mitra)
                ->get();
            return view('Rekap.tagpel', ['tagihan' => $tagihan, 'mitra' => $mitra]);
        } else {
            $tagihan = Tagihan::join('laypels', 'laypels.id_laypel', '=', 'tagihans.id_laypel')
                ->join('layanans', 'layanans.id_layanan', '=', 'laypels.id_layanan')
                ->join('mitras', 'mitras.id_mitra', '=', 'layanans.id_mitra')
                ->join('mitras', 'mitras.id_mitra', '=', 'laypels.id_mitra')
                ->get();
            return view('Rekap.tagpel', ['tagihan' => $tagihan]);
        }
    }

    public function detailtagpel($id_tagihan){

        $tagihan = new Tagihan();
        $tagihan = $tagihan->whereIdTagihan($id_tagihan)->firstOrFail();
        $detaillayanan = $tagihan->laypel()->join('layanans', 'laypels.id_layanan', '=', 'layanans.id_layanan')->get();
        $detailpelanggan =$tagihan->laypel()->join('pelanggans', 'laypels.id_pelanggan', '=', 'pelanggans.id_pelanggan')
            ->join('mitras', 'pelanggans.id_mitra', '=', 'mitras.id_mitra')->select('pelanggans.*', 'mitras.nama as nama_mitra')
            ->first();

        //dd($detailpelanggan, $detaillayanan, $tagihan);

        return view('Rekap.detailtagpel', ['tagihan' => $tagihan, 'detaillayanan' => $detaillayanan, 'detailpelanggan' => $detailpelanggan]);
    }

    public function viewtagpel(){

        $tagihan = Rekap::all();
        return view('Rekap.export', ['tagihan' => $tagihan]);
    }

    public function export() 
    {
        return Excel::download(new ExportTagihan, 'invoices.xlsx');
    }
}
 