<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPengembalianController extends Controller
{
    /**
     * Menampilkan daftar pengembalian milik user (semua status: pending, approved, rejected)
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $pengembalians = Pengembalian::with(['barang', 'peminjaman'])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'message' => 'Data pengembalian berhasil diambil',
            'data' => $pengembalians
        ]);
    }

    /**
     * Menampilkan detail satu pengembalian berdasarkan ID (hanya milik user sendiri)
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();

        $pengembalian = Pengembalian::with(['barang', 'peminjaman'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$pengembalian) {
            return response()->json([
                'message' => 'Data pengembalian tidak ditemukan atau bukan milik Anda'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail pengembalian berhasil diambil',
            'data' => $pengembalian
        ]);
    }

    /**
     * Menyimpan pengajuan pengembalian baru
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $user_id = $request->user()->id;
            $peminjaman = Peminjaman::findOrFail($id);

            $exist = Pengembalian::where('peminjaman_id', $id)
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            if ($exist) {
                return response()->json(['message' => 'Pengembalian untuk peminjaman ini sudah diajukan atau disetujui'], 400);
            }

            $fotoPath = null;
            if ($request->hasFile('image')) {
                $fotoPath = $request->file('image')->store('pengembalian_foto', 'public');
            }

            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $id,
                'user_id' => $user_id,
                'barang_id' => $peminjaman->barang_id,
                'image' => $fotoPath,
                'keterangan' => $request->keterangan,
                'jumlah' => $peminjaman->jumlah,
                'tanggal_pengembalian' => now()->toDateString(),
                'status' => 'pending',
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Pengembalian berhasil diajukan',
                'data' => $pengembalian
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menyimpan pengembalian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
