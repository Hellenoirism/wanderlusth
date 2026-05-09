<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_fasilitas'
    ];

    public function armadas(){
        return $this->belongsToMany(
            Armada::class,
            'armada_fasilitas', // nama pivot table
            'fasilitas_id',     // foreign key di pivot (untuk model ini)
            'armada_id'         // foreign key ke armada
        );
    }

}
