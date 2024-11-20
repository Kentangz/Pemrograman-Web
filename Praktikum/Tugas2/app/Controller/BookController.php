<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Book.php";  // Ganti 'Product.php' dengan 'Book.php'

use app\Models\Book;  // Ganti 'Product' dengan 'Book'
use app\Traits\ApiResponseFormatter;

class BookController {
    use ApiResponseFormatter;

    // Menampilkan semua buku
    public function index() {
        $bookModel = new Book();  // Ganti 'Product' dengan 'Book'
        $response = $bookModel->findAll();  // Menampilkan semua buku
        return $this->apiResponse(200, "success", $response);
    }

    // Menampilkan buku berdasarkan ID
    public function getById($id) {
        $bookModel = new Book();  // Ganti 'Product' dengan 'Book'
        $response = $bookModel->findById($id);  // Menampilkan buku berdasarkan ID
        return $this->apiResponse(200, "success", $response);
    }

    // Menambahkan buku baru
    public function insert() {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->apiResponse(400, "Error invalid input", null);
        }
    
        // Periksa apakah semua data yang diperlukan ada, termasuk 'image'
        if (!isset($inputData["book_name"], $inputData["creator"], $inputData["price"], $inputData["description"], $inputData["image"])) {
            return $this->apiResponse(400, "Missing required fields", null);
        }
    
        // Validasi tambahan
        if (!is_numeric($inputData['price']) || empty($inputData['book_name']) || empty($inputData['creator'])) {
            return $this->apiResponse(400, "Invalid data format", null);
        }
    
        // Validasi harga (price) lebih besar dari 0
        if ($inputData['price'] <= 0) {
            return $this->apiResponse(400, "Price must be greater than 0", null);
        }
    
        $bookModel = new Book();
        $response = $bookModel->create([
            "book_name" => $inputData["book_name"],
            "creator" => $inputData["creator"],
            "price" => $inputData["price"],
            "description" => $inputData["description"],
            "image" => $inputData["image"],  // Pastikan data image ada
        ]);
    
        return $this->apiResponse(200, "success", $response);
    }
    

    // Memperbarui data buku
    public function update($id) {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        
        if (json_last_error()) {
            return $this->apiResponse(400, "Error invalid input", null);
        }

        // Periksa apakah data yang diperlukan ada
        if (!isset($inputData["book_name"], $inputData["creator"], $inputData["price"], $inputData["description"])) {
            return $this->apiResponse(400, "Missing required fields", null);
        }

        $bookModel = new Book();  // Ganti 'Product' dengan 'Book'
        $response = $bookModel->update([
            "book_name" => $inputData["book_name"],  
            "creator" => $inputData["creator"],     
            "price" => $inputData["price"],         
            "description" => $inputData["description"],
            "image" => $inputData["image"], 
            "timestamp" => date("Y-m-d H:i:s")   
        ], $id);

        return $this->apiResponse(200, "success", $response);
    }

    // Menghapus buku berdasarkan ID
    public function delete($id) {
        $bookModel = new Book();  // Ganti 'Product' dengan 'Book'
        $response = $bookModel->delete($id);  // Menghapus buku berdasarkan ID
        return $this->apiResponse(200, "success", $response);
    }
}
