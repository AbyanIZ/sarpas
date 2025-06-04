<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanExport;

class LaporanPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'barang.kategori', 'approvedByUser'])->latest();

        // Filter tanggal pinjam
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }

        $peminjamans = $query->get();

        return view('laporan.peminjaman', compact('peminjamans'));
    }

    public function exportExcel(Request $request)
    {
        // Validasi tanggal jika ingin
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $start = $request->start_date;
        $end = $request->end_date;

        return Excel::download(new PeminjamanExport($start, $end), 'Laporan Peminjaman.xlsx');
    }
}
