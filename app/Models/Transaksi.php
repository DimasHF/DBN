<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    //Table
    protected $table = 'transaksis';

    //Primary Key
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    
}
