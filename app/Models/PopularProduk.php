<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularProduk extends Model
{
    protected $table = 'produk_populer'; // jika nama tabel tidak plural otomatis

    protected $fillable = [
        'id_produk',
        'nama_produk',
        'harga',
        'stok',
        'status',
        'gambar_produk',
    ];

    // Relasi ke produk (Product)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
