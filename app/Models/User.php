<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'level' => 'string',
    ];

    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'pelanggan_id', 'id');
    }

    public function paket(){
        return $this->hasMany(Pesanan::class, 'creator', 'id');
    }

    public function pelanggan(){
        return $this->hasOne(Pelanggan::class, 'user_id', 'id');
    }
}
