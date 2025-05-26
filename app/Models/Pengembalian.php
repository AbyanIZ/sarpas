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
        'user_id',
        'barang_id',
        'image',
        'peminjaman_id',
        'jumlah',
        'status',
        'tanggal_pengembalian',
    ];

    protected $dates = ['tanggal_pengembalian'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }


    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
