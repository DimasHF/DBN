<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanMitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tagmit',
        'id_mitra',
        'bayar',
        'sisa',
        'total',
        'statustag',
    ];

    protected $primaryKey = 'id_tagmit';
    public $incrementing = false;

}
