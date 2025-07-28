<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KabarPetualang extends Model
{
    use HasFactory;

    protected $table = 'kabar_petualang';

    protected $fillable = [
        'id_gunung',
        'id_lokasi',
        // tambahkan field lain seperti judul, isi, gambar, dll jika ada
    ];

    // Relasi ke tabel gunung
    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'id_gunung');
    }

    // Relasi ke tabel lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
}
