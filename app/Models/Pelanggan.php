<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'id_pelanggan');
    }
}
