<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Laypel;
use App\Models\Rekap;
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

    public function cetakTagihan($tglAwal)
    {

        $startDate = Carbon::createFromFormat('Y-m-d', $tglAwal);
        $telat = Carbon::createFromFormat('Y-m-d', $tglAwal);
        $endDate = $startDate->copy()->subDays(30);

        $bayar = new Bayar();
        $bayarget = $bayar->join('laypels', 'laypels.id_laypel', '=', 'bayars.id_laypel')
            ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'laypels.id_pelanggan')
            ->where(function ($query) use ($endDate) {
                $query->where('statusbayar', 0)
                    ->orWhereDate('tanggal_bayar', $endDate);
            })->get();

        foreach ($bayarget as $item) {
            $daysLate = $telat->diffInDays($item->tanggal_bayar, false);
            $item->daysLate = $daysLate;
        }

        return view('Tagihan.cetakperbulan', [
            'bayar' => $bayarget,
            'tglAwal' => $tglAwal,
            'daysLate' => $daysLate,
        ]);
    }

    //View Edit
    public function detail($id_laypel)
    {
        $bayar = Laypel::join('pelanggans', 'pelanggans.id_pelanggan', '=', 'laypels.id_pelanggan')
            ->join('bayars', 'bayars.id_laypel', '=', 'laypels.id_laypel')
            ->find($id_laypel);
        return response()->json([
            'status' => 200,
            'bayar' => $bayar
        ]);
    }

    //Update
    public function bayar(Request $request)
    {
        $autoId = DB::table('rekaps')->select(DB::raw('MAX(RIGHT(id_rekap,4)) as autoId'));
        $kdr = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kdr = sprintf("%04s", $tmp);
            }
        } else {
            $kdr = "0001";
        }

        $autoId = DB::table('tagihans')->select(DB::raw('MAX(RIGHT(id_tagihans,4)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        $id = $request->input('id');
        $bayarid = $request->input('id_laypel');
        $bayardet = Bayar::where('id_laypel', '=', $bayarid)->select('total', 'tanggal_bayar')->first();

        if (!$bayardet) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }


        $inputBayar = (float) $request->input('bayar'); // Konversi input ke angka

        if ($inputBayar > 0 && $inputBayar <= $bayardet->total) {
            $bayar = new Tagihan();
            $bayar->id_tagihan = ('TAG-' . $kd);
            $bayar->id_laypel = $request->input('id_laypel');
            $bayar->tanggal_bayar = date('Y-m-d');
            $bayar->tanggal_deadline = $request->input('tanggal_deadline');
            $bayar->pajak = $request->input('pajak');
            $bayar->telat = $request->input('telat');
            $bayar->bayar = $inputBayar;
            $bayar->sisa = $bayardet->total - $inputBayar;
            if ($bayar->sisa == 0) {
                $bayar->status = 1;
            } else {
                $bayar->status = 0;
            }
            // $bayar->save();

            $bayarsta = Bayar::where('id_laypel', '=', $bayarid)->first();
            if ($bayar->sisa == 0) {
                $bayarsta->statusbayar = 1;
            } else {
                $bayarsta->statusbayar = 0;
            }

            $rekap = new Rekap();
            $rekap->id_rekap = ('REK-' . $kdr);
            $rekap->id_tagihan = ('TAG-' . $kd);
            $rekap->status = 1;

            dd($bayar, $bayarsta, $rekap);

            return response()->json(['message' => 'Pembayaran berhasil disimpan']);
        } else {
            return response()->json(['message' => 'Jumlah pembayaran tidak valid'], 422);
        }
    }
}
