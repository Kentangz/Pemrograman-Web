<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books);
    }

    // Menambahkan buku baru
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_name' => 'required|string|max:255',
            'creator' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Jika validasi gagal, tampilkan pesan error
        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validatedData->errors(),
            ], 400);
        }

        // Menyimpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books/images', 'public');
        }

        // Menyimpan data buku ke database
        $book = Book::create([
            'image' => $imagePath,
            'book_name' => $request->book_name,
            'creator' => $request->creator,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return new BookResource($book); // Menggunakan BookResource
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404); // Peringatan jika buku tidak ditemukan
        }

        return new BookResource($book);
    }

    // Mengupdate data buku
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        // Validasi input
        $validatedData = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'book_name' => 'required|string|max:255',
            'creator' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Jika validasi gagal, tampilkan pesan error
        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validatedData->errors(),
            ], 400);
        }

        // Menyimpan gambar baru jika ada
        $imagePath = $book->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books/images', 'public');
        }

        // Mengupdate data buku
        $book->update([
            'image' => $imagePath,
            'book_name' => $request->book_name,
            'creator' => $request->creator,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return new BookResource($book); // Menggunakan BookResource
    }

    // Menghapus buku
    // Menghapus buku berdasarkan ID
// Menghapus buku
public function destroy($id)
{
    $book = Book::find($id);

    if (!$book) {
        return response()->json([
            'success' => false,
            'message' => 'Book not found'
        ], 404); // Peringatan jika buku tidak ditemukan
    }

    // Hapus gambar jika ada
    if ($book->image) {
        // Menghapus file gambar dari storage
        Storage::disk('public')->delete($book->image);
    }

    // Hapus data buku
    $book->delete();

    return response()->json([
        'success' => true,
        'message' => 'Book deleted successfully!'
    ]);
}

}

