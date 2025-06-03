<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangExport implements FromCollection
{
    protected $kategoriId;

    public function __construct($kategoriId = null)
    {
        $this->kategoriId = $kategoriId;
    }

    public function collection()
    {
        return Barang::with('kategori')
            ->when($this->kategoriId, function ($query) {
                $query->where('kategori_id', $this->kategoriId);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Barang' => $item->nama_barang,
                    'Kategori' => $item->kategori->nama_kategori ?? '-',
                    'Stock' => $item->stock,
                    'Tanggal' => $item->created_at->format('d M Y H:i'),
                ];
            });
    }
}
