<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class ApiPengembalianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date',
        ]);

        $user_id = $request->user()->id;

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        if ($peminjaman->barang_id !== (int)$request->barang_id) {
            return response()->json(['message' => 'Barang yang dikembalikan tidak sesuai dengan peminjaman'], 400);
        }

        if ($request->jumlah > $peminjaman->jumlah) {
            return response()->json(['message' => 'Jumlah pengembalian melebihi jumlah yang dipinjam'], 400);
        }

        // Cek jika sudah pernah mengajukan pengembalian
        $sudahAjukan = Pengembalian::where('peminjaman_id', $peminjaman->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($sudahAjukan) {
            return response()->json(['message' => 'Pengembalian untuk peminjaman ini sudah diajukan atau disetujui'], 400);
        }

        // Simpan pengembalian sebagai pending
        $pengembalian = Pengembalian::create([
            'user_id' => $user_id,
            'peminjaman_id' => $request->peminjaman_id,
            'image' => $request->file('image') ? $request->file('image')->store('images/pengembalian') : null,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'pending', // belum ditambahkan ke stok sampai admin approve
        ]);

        return response()->json([
            'message' => 'Pengembalian berhasil diajukan, menunggu persetujuan admin.',
            'data' => $pengembalian
        ], 201);
    }
}
