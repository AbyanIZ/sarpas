<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ApiPeminjamanController extends Controller
{
    // Menampilkan semua peminjaman
    public function index()
{
    $peminjamans = Peminjaman::with(['user:id,name,email', 'barang:id,nama,stock'])
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Daftar semua peminjaman',
        'data' => $peminjamans
    ]);
}

    // Menampilkan status peminjaman berdasarkan ID
    public function show($id)
    {
        $peminjaman = Peminjaman::with('user', 'barang')->find($id);

        if ($peminjaman) {
            return response()->json($peminjaman);
        } else {
            return response()->json(['message' => 'Peminjaman tidak ditemukan'], 404);
        }
    }

    // Approve peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'approved';
        $peminjaman->save();

        // Kurangi stok barang
        $peminjaman->barang->decrement('stock');

        return response()->json(['message' => 'Peminjaman disetujui.']);
    }

    // Reject peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'rejected';
        $peminjaman->save();

        return response()->json(['message' => 'Peminjaman ditolak.']);
    }
}
