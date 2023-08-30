<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Laypel;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    //Index
    public function index()
    {
        return view('Tagihan.index');
    }

    //cetak
    public function cetak($tgl_awal, $tgl_akhir)
    {
        // $cetak = collect("Awal".$tgl_awal." ".$tgl_akhir);
        // $cetak->dd();

        $cetak = DB::table('transaksis')->whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
        //$cetak->dd();
        return view('Tagihan.cetak', compact('cetak'));
    }

    //View Cetak Perbulan
    public function viewcetakperbulan()
    {
        return view('Tagihan.cetakperbulan');
    }

    public function cetakTagihan($tglAwal, $tglAkhir)
    {

        $startDate = Carbon::createFromFormat('Y-m-d', $tglAwal);
        $endDate = $startDate->copy()->subDays(30);

        $bayar = new Bayar();
        $bayarget = $bayar->where(function ($query) use ($endDate) {
            $query->where('status', 0)
                ->orWhereDate('tanggal_bayar', $endDate);
        })->get();

        foreach ($bayarget as $item) {
            $daysLate = now()->diffInDays($item->tanggal_bayar, false);
            $item->daysLate = $daysLate;
        }

        $layanan = $bayar->laypel()->join('layanans', 'layanans.id_layanan', '=', 'laypels.id_layanan')->get();
        $pelanggan = $bayar->laypel()->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'laypels.id_pelanggan')->get();

        return view('Tagihan.cetakperbulan', [
            'bayar' => $bayarget,
            'layanan' => $layanan,
            'pelanggan' => $pelanggan,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'daysLate' => $daysLate,
        ]);
    }

    public function bayar(Request $request, $status, $id_bayar)
    {
        $model = Bayar::join('laypels', 'laypels.id_laypel', '=', 'bayars.id_laypel')
            ->select('bayars.*', 'laypels.*')
            ->where('bayars.id_bayar', $id_bayar)
            ->first();
        $model->status = $status;

        //dd($model);
        // if ($model->save()) {

        //     $notice = ['alert' => 'Status Telah Diganti'];
        // }

        $autoId = DB::table('tagihans')->select(DB::raw('MAX(RIGHT(id_tagihans,5)) as autoId'));
        $kdt = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kdt = sprintf("%05s", $tmp);
            }
        } else {
            $kdt = "00001";
        }

        $tagihan = new Tagihan;
        $tagihandet = $tagihan->laypel()->first();
        $tagihanbay = $tagihan->bayar()->first();

        $tagihan->id_tagihan = ('TAG' . date('Y-m-d') . $kdt);
        $tagihan->id_bayar = $id_bayar;
        $tagihan->tanggal_bayar = date('Y-m-d');
        $tagihan->tanggal_deadline = $request->endDate;
        if ($tagihandet) {
            $tagihan->pajak = $tagihandet->pajak;
        }
        $tagihan->telat = $request->daysLate;
        if ($tagihanbay) {
            $tagihan->bayar = $tagihanbay->total;
        }        // $tagihan->sisa = $tagihanbay->total - $tagihanbay->bayar;
        $tagihan->status = 1;
        dd($tagihan);

        
        // return redirect()->back()->with($notice);
    }
}
