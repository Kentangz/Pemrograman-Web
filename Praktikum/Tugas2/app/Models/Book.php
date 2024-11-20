<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Book extends DatabaseConfig {  
    public $conn;

    public function __construct() {
        // Connect ke database MySQL
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Function menampilkan semua data buku
    public function findAll() {
        $sql = "SELECT * FROM books";  // Mengambil semua data buku
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Function menampilkan data buku berdasarkan ID
    public function findById($id) {
        $sql = "SELECT * FROM books WHERE id = ?";  // Mengambil buku berdasarkan ID
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Function untuk membuat buku baru
    public function create($data) {
        $bookName = $data['book_name'];  
        $creator = $data['creator'];  
        $price = $data['price'];  
        $description = $data['description'];  
        $image = $data['image']; // Menambahkan field untuk gambar
    
        // Query untuk insert data buku
        $query = "INSERT INTO books (book_name, creator, price, description, image) VALUES (?, ?, ?, ?, ?)";  
        $stmt = $this->conn->prepare($query);
        // Menyesuaikan jumlah parameter dengan query, yaitu 5 parameter
        $stmt->bind_param("ssdss", $bookName, $creator, $price, $description, $image);  // Ubah "s" untuk image jika itu string
        $stmt->execute();
    }

    // Function untuk update buku
    public function update($data, $id) {
        $bookName = $data['book_name'];  
        $creator = $data['creator'];  
        $price = $data['price'];  
        $description = $data['description'];  
        $image = $data['image'];  // Menambahkan field untuk gambar
    
        // Query untuk update data buku
        $query = "UPDATE books SET book_name = ?, creator = ?, price = ?, description = ?, image = ? WHERE id = ?";  
        $stmt = $this->conn->prepare($query);
    
        // Perbaiki binding parameter di sini
        $stmt->bind_param("ssdssi", $bookName, $creator, $price, $description, $image, $id); // Pastikan 'i' untuk id
    
        // Eksekusi statement
        $stmt->execute();
    }

    // Function untuk menghapus buku berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM books WHERE id = ?";  // Query untuk menghapus buku berdasarkan ID
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
