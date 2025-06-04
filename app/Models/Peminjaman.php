<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Barang;
use App\Models\Pengembalian;

class Peminjaman extends Model
{
    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'approved_by', 
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pengembalians()
    {
        return $this->hasMany(Pengembalian::class);
    }
    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
