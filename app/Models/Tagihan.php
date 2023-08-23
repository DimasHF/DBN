<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagihan',
        'id_laypel',
        'pajak',
        'total',
        'status',
    ];

    protected $primaryKey = 'id_tagihan';

    public function laypel()
    {
        return $this->belongsTo(Laypel::class, 'id_laypel', 'id_laypel');
    }
}
