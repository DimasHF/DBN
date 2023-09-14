<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Mitra extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $primaryKey = 'id_mitra';
    public $incrementing = false;

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, 'id_mitra', 'id_mitra');
    }
}
