<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Ambil data peminjaman lengkap dengan relasi user dan barang, terbaru di atas
        $peminjamans = Peminjaman::with(['user', 'barang', 'approvedBy'])->latest()->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::all();
        $barangs = Barang::all();
        return view('peminjaman.create', compact('users', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stock < $request->jumlah) {
            return back()->with('error', 'Stok barang tidak mencukupi. Stok saat ini: ' . $barang->stock)->withInput();
        }

        Peminjaman::create([
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'pending',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function approve($id)
    {
        $peminjaman = Peminjaman::with('barang')->findOrFail($id);

        if ($peminjaman->barang->stock < $peminjaman->jumlah) {
            return back()->withErrors(['stok' => 'Stok barang tidak cukup untuk peminjaman. Stok saat ini: ' . $peminjaman->barang->stock]);
        }

        DB::transaction(function () use ($peminjaman) {
            $peminjaman->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
            ]);

            $peminjaman->barang->decrement('stock', $peminjaman->jumlah);
        });

        return back()->with('success', 'Peminjaman disetujui dan stok barang telah dikurangi.');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Hanya peminjaman dengan status pending yang bisa ditolak.');
        }

        // ✅ PERBAIKAN DISINI: pisahkan update dan return
        $peminjaman->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        return back()->with('error', 'Peminjaman ditolak.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'selesai') {
            $peminjaman->delete();
            return back()->with('success', 'Riwayat peminjaman dihapus.');
        }

        return back()->with('error', 'Hanya peminjaman yang sudah selesai bisa dihapus.');
    }
}
