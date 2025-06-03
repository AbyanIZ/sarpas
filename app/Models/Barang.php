<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang', 'deskripsi', 'stock', 'kategori_id', 'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class);
    }
    public function peminjamans()
{
    return $this->hasMany(Peminjaman::class);
}


}
