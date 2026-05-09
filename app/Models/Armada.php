<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Armada extends Model
{
    use HasFactory;
    
    protected $table = 'armadas';
    protected $primaryKey = 'id_armada';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'jenis_kendaraan',
        'plat_nomor',
        'kapasitas',
        'harga_sewa'
    ];


    public function fasilitas(){
        return $this->belongsToMany(
            Fasilitas::class,
            'armada_fasilitas',
            'armada_id',
            'fasilitas_id'
        );
    }

    public function reservasis(){
        return $this->hasMany(Reservasi::class, 'id_armada', 'id_armada');
    }
}
