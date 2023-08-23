<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laypel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_laypel',
        'id_pelanggan',
        'id_layanan',
        'tanggal',
        'pajak',
        'status',
    ];

    protected $primaryKey = 'id_laypel';
    public $incrementing = false;
    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
