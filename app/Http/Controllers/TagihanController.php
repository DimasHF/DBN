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

        if (Auth::guard('mitra')->check()) {

            $startDate = Carbon::createFromFormat('Y-m-d', $tglAwal);
            $telat = Carbon::createFromFormat('Y-m-d', $tglAwal);

            $mitra = Auth::guard('mitra')->user()->id_mitra;
            $bayar = new Bayar();
            $bayarget = $bayar->join('laypels', 'laypels.id_laypel', '=', 'bayars.id_laypel')
                ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'laypels.id_pelanggan')
                ->where('id_mitra', $mitra)
                ->where(function ($query) use ($startDate) {
                    $query->whereDate('tanggal_telat', '<', $startDate)
                        ->orWhereDate('tanggal_bayar', $startDate);
                })->get();

            $daysLateArray = [];
            $totalMultiplier = 1; // Faktor pengganda awal
            $totalLateMultiplier = -30;

            foreach ($bayarget as $item) {
                $daysLate = $telat->diffInDays($item->tanggal_telat, false);

                if ($item->statusbayar == 0) {
                    $item->daysLate = $daysLate;
                } else {
                    $item->daysLate = 0;
                }

                //dump($daysLate);

                $total = $item->total;
                $daysLateArray[] = $daysLate;

                if ($daysLate < -30) {
                    $multiplier = floor($daysLate / $totalLateMultiplier); // Hitung pengganda
                    $totalMultiplier = $multiplier + 1; // Tambahkan pengganda ke total
                    $item->finalTotal = $total * $totalMultiplier; // Hitung finalTotal untuk objek $item
                } else {
                    $item->finalTotal = $total;
                }
            }

            return view('Tagihan.cetakperbulan', [
                'bayar' => $bayarget,
                'tglAwal' => $tglAwal,
            ]);
        } else {

            $startDate = Carbon::createFromFormat('Y-m-d', $tglAwal);
            $telat = Carbon::createFromFormat('Y-m-d', $tglAwal);

            $bayar = new Bayar();
            $bayarget = $bayar->join('laypels', 'laypels.id_laypel', '=', 'bayars.id_laypel')
                ->join('pelanggans', 'pelanggans.id_pelanggan', '=', 'laypels.id_pelanggan')
                ->where(function ($query) use ($startDate) {
                    $query->where('statusbayar', 0)
                        ->orWhereDate('tanggal_bayar', $startDate);
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

        //dd($request->all());
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

        $autoId = DB::table('tagihans')->select(DB::raw('MAX(RIGHT(id_tagihan,4)) as autoId'));
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

        if ($inputBayar >= 0 && $inputBayar <= $bayardet->total) {
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
                $bayar->statustagihan = 1;
            } else {
                $bayar->statustagihan = 0;
            }

            //dd($bayar);
            $bayar->save();

            $bayarsta = Bayar::where('id_laypel', '=', $bayarid)->first();
            $tanggal = $bayarsta->tanggal_bayar;

            $tanggal = Carbon::parse($tanggal);
            $bayardata = $tanggal->addDays(30);
            $nextbayar = $bayardata->format('Y-m-d');

            $bayarsta->tanggal_bayar = $nextbayar;
            //dd($bayar);
            if ($bayar->sisa == 0) {
                $bayarsta->statusbayar = 1;
                $bayarsta->tanggal_telat = $nextbayar;

            } else {
                $bayarsta->statusbayar = 0;
            }
            $bayarsta->save();
            //dd($bayarsta);
            //dd($bayarsta);

            $rekap = new Rekap();
            $rekap->id_rekap = ('REK-' . $kdr);
            $rekap->id_tagihan = ('TAG-' . $kd);
            $rekap->statusrek = 1;
            $rekap->save();

            //dd($bayar, $bayarsta, $rekap);

            return redirect()->back()->with('alert', 'Pembayaran Diterima');
        } else {
            return response()->json(['message' => 'Jumlah pembayaran tidak valid'], 422);
        }
    }

    public function updatetanggal($id_bayar)
    {
        $tanggal_bayar = Bayar::select('tanggal_bayar')->where('id_bayar', $id_bayar)->first();
        // dd($tanggal_bayar);
        if ($tanggal_bayar) {
            $bayar = $tanggal_bayar->tanggal_bayar;
            //dd($today);
            $bayar = Carbon::parse($bayar);
            $bayardata = $bayar->addDays(30);
            $nextbayar = $bayardata->format('Y-m-d');

            $bayar = Bayar::where('id_bayar', $id_bayar)->first();
            $bayar->tanggal_telat = $nextbayar;
            $bayar->tanggal_bayar = $nextbayar;
            $bayar->save();
            //dd($bayar);
        }

        return redirect()->back()->with('alert', 'Data Berhasil Diubah');
    }

    public function updatetelat($id_bayar)
    {
        $tanggal_bayar = Bayar::select('tanggal_bayar')->where('id_bayar', $id_bayar)->first();
        if ($tanggal_bayar) {

            $bayar = $tanggal_bayar->tanggal_bayar;

            $bayar = Carbon::parse($bayar);
            $bayardata = $bayar->addDays(30);
            $nextbayar = $bayardata->format('Y-m-d');

            $bayar = Bayar::where('id_bayar', $id_bayar)->first();
            $bayar->tanggal_bayar = $nextbayar;
            $bayar->statusbayar = 0;
            $bayar->save();
            //dd($bayar);

        }

        return redirect()->back()->with('alert', 'Data Berhasil Diubah');
    }
}
