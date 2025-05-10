<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ApiPeminjamanController extends Controller
{
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

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user:id,name,email', 'barang:id,nama,stock'])->find($id);

        if ($peminjaman) {
            return response()->json([
                'status' => true,
                'message' => 'Peminjaman ditemukan',
                'data' => $peminjaman
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman tidak ditemukan'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stock < $request->jumlah) {
            return response()->json([
                'status' => false,
                'message' => 'Stok barang tidak mencukupi'
            ], 400);
        }

        $peminjaman = Peminjaman::create([
            'user_id' => $request->user()->id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => Carbon::now()->addDays(7)->toDateString(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman berhasil diajukan.',
            'data' => $peminjaman,
        ], 201);
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman sudah diproses sebelumnya.'
            ], 400);
        }

        if ($peminjaman->barang->stock < $peminjaman->jumlah) {
            return response()->json([
                'status' => false,
                'message' => 'Stok barang tidak cukup untuk dipinjam.'
            ], 400);
        }

        $peminjaman->status = 'approved';
        $peminjaman->save();
        $peminjaman->barang->decrement('stock', $peminjaman->jumlah);

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman disetujui.'
        ]);
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman sudah diproses sebelumnya.'
            ], 400);
        }

        $peminjaman->status = 'rejected';
        $peminjaman->save();

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman ditolak.'
        ]);
    }
}
