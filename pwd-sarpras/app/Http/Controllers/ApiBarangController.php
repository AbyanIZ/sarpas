<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class ApiBarangController extends Controller
{
    // Tampilkan semua barang
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return response()->json($barangs);
    }

    // Tampilkan satu barang
    public function show($id)
    {
        $barang = Barang::with('kategori')->find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        return response()->json($barang);
    }

    // Tambah barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_barangs,id',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
        ]);

        return response()->json($barang, 201); // 201 Created
    }

    // Update barang
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'kategori_id' => 'sometimes|exists:kategori_barangs,id',
            'stok' => 'sometimes|integer|min:0',
        ]);

        $barang->update($request->only(['nama', 'kategori_id', 'stok']));

        return response()->json($barang);
    }

    // Hapus barang
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->delete();

        return response()->json(['message' => 'Barang deleted successfully']);
    }
}
