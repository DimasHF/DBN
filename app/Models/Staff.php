<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'id_staff',
        'nama',
        'username',
        'password',
        'email',
        'alamat',
        'no_telp',
        'status',
    ];

    protected $primaryKey = 'id_staff';
    public $incrementing = false;
    
}
