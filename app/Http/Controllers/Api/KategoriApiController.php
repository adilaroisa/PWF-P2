<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriApiController extends Controller
{
    public function index()
    {
        // Mengambil seluruh kategori beserta data product-nya
        $kategoris = Kategori::with('product')->get();
        return response()->json(['message' => 'Success', 'data' => $kategoris], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
        ]);

        $kategori = Kategori::create($validated);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    public function show($id)
    {
        $kategori = Kategori::with('product')->find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Success', 'data' => $kategori], 200);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'name' => 'sometimes|required|string|max:255',
        ]);

        $kategori->update($validated);

        return response()->json(['message' => 'Kategori berhasil diupdate', 'data' => $kategori], 200);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $kategori->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }
}