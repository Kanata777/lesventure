<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Porter extends Model
{
    use HasFactory;

    protected $table = 'porter';

    protected $fillable = [
        'nama_porter',
        'usia',
        'harga_per_sewa',
        'jenis_kelamin',
        'pengalaman_tahun',
        'status',
        'kontak',
        'foto',
        'id_lokasi' // tambahkan ini agar mass assignment bisa menyertakan relasi
    ];

    /**
     * Relasi ke tabel lokasi
     */
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
}
