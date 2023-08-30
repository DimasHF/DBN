<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_bayar',
        'id_laypel',
        'tanggal_bayar',
        'total',
        'status',
    ];

    protected $primaryKey = 'id_bayar';
    public $incrementing = false;

    public function laypel()
    {
        return $this->belongsTo(Laypel::class, 'id_laypel', 'id_laypel');
    }

}
