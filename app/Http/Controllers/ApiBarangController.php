<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class ApiBarangController extends Controller
{

    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data barang berhasil diambil',
            'data' => $barangs
        ]);
    }

    public function show($id)
    {
        $barang = Barang::with('kategori')->find($id);

        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Barang ditemukan',
            'data' => $barang
        ]);
    }

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

        return response()->json([
            'status' => true,
            'message' => 'Barang berhasil ditambahkan',
            'data' => $barang
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang not found'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'kategori_id' => 'sometimes|exists:kategori_barangs,id',
            'stok' => 'sometimes|integer|min:0',
        ]);

        $barang->update($request->only(['nama', 'kategori_id', 'stok']));

        return response()->json([
            'status' => true,
            'message' => 'Barang berhasil diperbarui',
            'data' => $barang
        ]);
    }
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang not found'
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'status' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }
}
