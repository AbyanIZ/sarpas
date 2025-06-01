<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        // Menampilkan pengembalian terbaru di atas
        $pengembalians = Pengembalian::with(['barang', 'user'])->latest()->get();
        $totalPengembalian = $pengembalians->count();

        return view('pengembalian.index', compact('pengembalians', 'totalPengembalian'));
    }

    public function create()
    {
        $user_id = auth()->id();

        $peminjamans = Peminjaman::with('barang')
            ->where('user_id', $user_id)
            ->where('status', 'approved')
            ->get();

        $peminjamansFiltered = $peminjamans->filter(function ($peminjaman) {
            $pengembalianAda = $peminjaman->pengembalians()
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            return !$pengembalianAda;
        });

        return view('pengembalian.create', [
            'peminjamans' => $peminjamansFiltered,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengembalian' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user_id = auth()->id();

        $peminjaman = Peminjaman::where([
            ['user_id', $user_id],
            ['barang_id', $request->barang_id],
            ['status', 'approved'],
        ])->latest()->first();

        if (!$peminjaman) {
            return back()->withErrors(['barang_id' => 'Tidak ada peminjaman aktif untuk barang ini.'])->withInput();
        }

        if ($request->jumlah > $peminjaman->jumlah) {
            return back()->withErrors(['jumlah' => 'Jumlah pengembalian tidak boleh lebih dari jumlah barang yang dipinjam (' . $peminjaman->jumlah . ').'])->withInput();
        }

        $sudahAjukan = Pengembalian::where('peminjaman_id', $peminjaman->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($sudahAjukan) {
            return back()->withErrors(['barang_id' => 'Pengembalian untuk barang ini sudah diajukan.'])->withInput();
        }

        $fotoPath = $request->file('image')->store('pengembalian_foto', 'public');

        Pengembalian::create([
            'user_id' => $user_id,
            'barang_id' => $request->barang_id,
            'peminjaman_id' => $peminjaman->id,
            'image' => $fotoPath,
            'jumlah' => $request->jumlah,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => 'pending',
        ]);

        return redirect()->route('pengembalian.index')->with('success', 'Permintaan pengembalian berhasil dikirim.');
    }

    public function approve($id)
    {
        $pengembalian = Pengembalian::with('barang', 'peminjaman')->findOrFail($id);

        if ($pengembalian->status === 'approved') {
            return back()->with('error', 'Pengembalian sudah disetujui sebelumnya.');
        }

        DB::beginTransaction();
        try {
            $pengembalian->update(['status' => 'approved']);
            $pengembalian->barang->increment('stock', $pengembalian->jumlah);
            $pengembalian->peminjaman->update(['status' => 'selesai']);

            DB::commit();

            return redirect()->route('pengembalian.index')->with('success', 'Pengembalian disetujui. Stok barang telah diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui pengembalian: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        if ($pengembalian->status !== 'pending') {
            return back()->with('error', 'Hanya pengembalian dengan status pending yang bisa ditolak.');
        }

        $pengembalian->update(['status' => 'rejected']);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil ditolak.');
    }
}
