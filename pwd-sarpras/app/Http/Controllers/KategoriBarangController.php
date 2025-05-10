<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategoris = KategoriBarang::all();
        return view('kategori.index', compact('kategoris'));
    }

    // Menampilkan form untuk menambah kategori
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan kategori baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(KategoriBarang $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    // Memperbarui kategori di dalam database
    public function update(Request $request, KategoriBarang $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        // Update kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    // Menghapus kategori
    public function destroy(KategoriBarang $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
