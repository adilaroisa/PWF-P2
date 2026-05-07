<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest; // <- Tambahkan import ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    // GET: Menampilkan semua data product (Tugas Praktikum)
    public function index()
    {
        $products = Product::with('kategoris')->get();
        return response()->json(['message' => 'Success', 'data' => $products], 200);
    }

    // POST: Menyimpan data product baru (Sama persis dengan Github code-worker)
    public function store(StoreProductRequest $request)
    {
        try {
            // Menggunakan validated() dari StoreProductRequest
            $validated = $request->validated();

            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);
            // Menambahkan return response agar API tetap membalas dengan JSON saat error
            return response()->json(['message' => 'Server error'], 500); 
        }
    }

    // GET: Menampilkan detail product berdasarkan ID (Sama persis dengan Github, disesuaikan kategoris)
    public function show(int $id)
    {
        try {
            $product = Product::with('kategoris')->find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Server error'], 500);
        }
    }

    // PUT: Mengupdate data product (Tugas Praktikum)
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            // Jika punya UpdateProductRequest, bisa diganti seperti method store di atas
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'qty' => 'sometimes|required|integer',
                'price' => 'sometimes|required|numeric',
            ]);

            $product->update($validated);

            return response()->json([
                'message' => 'Product berhasil diupdate',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal update data produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Server error'], 500);
        }
    }

    // DELETE: Menghapus data product (Tugas Praktikum)
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $product->delete();

            return response()->json(['message' => 'Product berhasil dihapus'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}