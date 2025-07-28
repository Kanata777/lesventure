<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // tabel utama produk

    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'status',
        'gambar_produk',
        // dan kolom lain sesuai tabel products kamu
    ];

    // Relasi ke popular product (one to many)
    public function popularProduk()
    {
        return $this->hasMany(PopularProduk::class, 'id_produk');
    }

    // Relasi ke keranjang (one to many)
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_produk','id');
    }
}
