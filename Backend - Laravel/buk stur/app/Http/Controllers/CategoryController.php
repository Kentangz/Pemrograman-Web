<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories); // Menggunakan CategoryResource
    }

    // Menambahkan kategori baru
    public function store(Request $request)
    {
        // Definisikan aturan validasi
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:255',
            'description' => 'nullable|max:500',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error!',
                'errors' => $validator->errors()
            ], 422);
        }

        // Jika validasi sukses, lanjutkan untuk menyimpan data kategori
        $category = Category::create($request->all());

        return new CategoryResource($category); // Menggunakan CategoryResource
    }

    // Menampilkan detail kategori
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404); // Peringatan jika kategori tidak ditemukan
        }

        return new CategoryResource($category);
    }

    // Mengupdate kategori
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
        $validatedData = Validator::make($request->all(), [
            'category_name' => 'required|max:255',
            'description' => 'nullable|max:500',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validatedData->errors(),
            ], 400);
        }

        $category->update($request->all());

        return new CategoryResource($category);
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404); // Peringatan jika kategori tidak ditemukan
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!'
        ]);
    }
}
