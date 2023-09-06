<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportTagihan implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\View
    */

    use Exportable;

    protected $tgl_awal;
    protected $tgl_akhir;

    public function __construct($tgl_awal, $tgl_akhir)
    {
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }

    public function collection()
    {
        return DB::table('tagihans')
            ->join('laypels', 'laypels.id_laypel', '=', 'tagihans.id_laypel')
            ->whereBetween('tanggal_bayar', [$this->tgl_awal, $this->tgl_akhir])
            ->get();
    }

    public function map($tagihan):array
    {
        return [

            $tagihan->id_tagihan,
            $tagihan->id_laypel,
            $tagihan->id_pelanggan,
            $tagihan->id_layanan,
            $tagihan->bayar,
            $tagihan->tanggal_bayar,
        ];
    }

    public function headings():array
    {
        return [
            //pastikan urut dan jumlahnya sesuai dengan yang ada di mapping-data atau table di database
            'ID Tagihan',
            'ID Layanan Pelanggan',
            'ID Pelanggan',
            'ID Layanan',
            'Bayar',
            'Tanggal Bayar',
        ];
    }
}
