<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'pelanggan';

    protected $fillable = [
        'user_id',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pesananPelanggan(){
        return $this->hasMany(Pesanan::class, 'pelanggan_id', 'user_id');
    }
}
