<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Lihat semua peminjaman (untuk admin)
    public function index()
    {
        $peminjamans = Peminjaman::with('user', 'barang')->where('status', 'pending')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    // Untuk approve peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'approved';
        $peminjaman->save();

        // Kurangi stok barang
        $peminjaman->barang->decrement('stock');

        return back()->with('success', 'Peminjaman disetujui.');
    }

    // Untuk reject peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'rejected';
        $peminjaman->save();

        return back()->with('error', 'Peminjaman ditolak.');
    }
}
