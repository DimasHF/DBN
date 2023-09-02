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
        $tagihan = Tagihan::all();
        return view('Rekap.export', ['tagihan' => $tagihan]);
    }
}
