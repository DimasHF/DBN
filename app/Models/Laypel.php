<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laypel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_laypel',
        'id_transasksi',
        'id_pelanggan',
        'id_layanan',
        'harga',
        'pajak',
        'subtotal',
        'statuslaypel',
    ];

    protected $primaryKey = 'id_laypel';
    public $incrementing = false;
    
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_laypel', 'id_laypel');
    }
}
