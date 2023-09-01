<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_rekap',
        'id_tagihan',
        'statusrek',
    ];

    protected $primaryKey = 'id_rekap';
    public $incrementing = false;

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }
}
