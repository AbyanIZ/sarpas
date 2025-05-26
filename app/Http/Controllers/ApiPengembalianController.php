<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPengembalianController extends Controller
{
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

            if (Pengembalian::where('peminjaman_id', $id)->exists()) {
                return response()->json(['message' => 'Pengembalian untuk peminjaman ini sudah ada'], 400);
            }

            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $id,
                'user_id' => $user_id,
                'barang_id' => $peminjaman->barang_id,
                'image' => $request->file('image') ? $request->file('image')->store('images/pengembalian') : null,
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
