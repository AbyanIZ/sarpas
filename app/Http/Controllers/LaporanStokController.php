<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use App\Exports\BarangExport;           // Import Export class
use Maatwebsite\Excel\Facades\Excel;    // Import Excel facade

class LaporanStokController extends Controller
{
    // Menampilkan halaman laporan stok barang dengan filter kategori
    public function index(Request $request)
    {
        $kategoriId = $request->kategori;  // ambil parameter filter kategori

        $barangs = Barang::with('kategori')
            ->when($kategoriId, function ($query) use ($kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->get();

        $kategoris = KategoriBarang::all();

        return view('laporan.stok', compact('barangs', 'kategoris'));
    }

    // Fungsi export laporan stok ke Excel
    public function exportExcel(Request $request)
    {
        // Jika mau filter kategori di export juga, bisa ambil param dan teruskan ke export
        $kategoriId = $request->kategori;

        // Misal kita buat export dinamis dengan filter kategori
        return Excel::download(new BarangExport($kategoriId), 'laporan-stok.xlsx');
    }
}
