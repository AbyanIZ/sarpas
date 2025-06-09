<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Exports\PengembalianExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['user', 'approvedBy', 'barang'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('laporan.pengembalian', compact('pengembalians'));
    }

    public function exportExcel()
    {
        return Excel::download(new PengembalianExport, 'laporan_pengembalian.xlsx');
    }
}
