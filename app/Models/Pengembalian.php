<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Barang;
use App\Models\Peminjaman;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id', // Ganti peminjaman_id -> borrowing_id
        'user_id',
        'barang_id',
        'image',
        'jumlah',
        'status',
        'tanggal_pengembalian',
        'keterangan'
    ];

    // Relasi ke peminjaman
    public function borrowing()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke Peminjaman (menggunakan id sebagai foreign key)
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
