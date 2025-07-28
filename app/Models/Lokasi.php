<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi'; // nama tabel di database

    protected $fillable = [
        'nama_lokasi',
    ];

    /**
     * Relasi ke porter (satu lokasi bisa punya banyak porter)
     */
    public function porters()
    {
        return $this->hasMany(Porter::class, 'id_lokasi');
    }

    /**
     * Relasi ke gunung (satu lokasi bisa punya banyak gunung)
     */
    public function gunungs()
    {
        return $this->hasMany(Gunung::class, 'id_lokasi');
    }
     public function kabarPetualang()
    {
        return $this->hasMany(KabarPetualang::class, 'id_lokasi');
    }
}
