<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\KategoriBarang;

class LaporanStok extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'barang_id',
        'nama_barang',
        'gambar',
        'perubahan',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function kategori()
{
    return $this->belongsTo(KategoriBarang::class);
}

}
