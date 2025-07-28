<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gunung extends Model
{
    use HasFactory;

    protected $table = 'gunung'; // Nama tabelnya 'gunung'

    protected $fillable = [
        'nama_gunung',
        'ketinggian',
        'id_lokasi',
    ];

    /**
     * Relasi ke Lokasi
     * Setiap gunung berada dalam satu lokasi (provinsi)
     */
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
     public function kabarPetualang()
    {
        return $this->hasMany(KabarPetualang::class, 'id_gunung');
    }
}
