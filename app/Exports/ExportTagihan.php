<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportTagihan implements FromView
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view() : View
    {
        $tagihan = Tagihan::orderBy('id_tagihan', 'desc')->get();
        return view('Cetak.cetaktagihan', ['cetak' => $tagihan]);
    }
}
