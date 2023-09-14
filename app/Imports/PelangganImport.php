<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelangganImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $autoId = DB::table('pelanggans')->select(DB::raw('MAX(RIGHT(id_pelanggan,5)) as autoId'))->first();
        $kd = "";

        if ($autoId !== null) {
            $tmp = ((int)$autoId->autoId) + 1;
            $kd = sprintf("%05s", $tmp);
        } else {
            $kd = "00001";
        }

        $mitra = Auth::guard('mitra')->user()->id_mitra;

        return new Pelanggan([
            'id_pelanggan' => $kd,
            'id_mitra' => $mitra,
            'nama_pel' => $row['nama_pel'],
            'alamat' => $row['alamat'],
            'no_telp' => $row['no_telp'],
            'email' => $row['email'],
            'nik' => $row['nik'],
            'npwp' => $row['npwp'],
            'statuspel' => 1,
        ]);
    }
}
