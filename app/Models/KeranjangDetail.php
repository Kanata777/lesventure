<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Produk;
use App\Models\Keranjang;

class KeranjangDetail extends Model
{
    use HasFactory;

    protected $table = 'keranjang_detail'; // Nama tabel

    // Hapus baris primaryKey karena kita pakai default 'id'
    protected $fillable = [
        'id_keranjang', // ✅ ini wajib ditambahkan agar bisa diisi saat create
        'id_produk',
        'jumlah',
        'total_harga',
    ];

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    // Relasi ke keranjang
    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang', 'id');
    }
}
