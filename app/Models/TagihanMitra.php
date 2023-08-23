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
        'tanggal',
        'status',
    ];

    protected $primaryKey = 'id_tagmit';
    public $incrementing = false;

}
