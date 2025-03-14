<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'book_name',
        'creator',
        'price',
        'description',
        'category_id', // Pastikan kolom category_id ada di tabel books
    ];

    // Accessor untuk book_name
    public function getBookNameAttribute($value)
    {
        return ucfirst($value); // Mengubah nama buku menjadi huruf kapital pertama
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class); // Relasi belongsTo ke Category
    }
}
