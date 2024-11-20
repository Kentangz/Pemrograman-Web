<?php

header("Content-Type: application/json; charset=UTF-8");

include "app/Routes/BookRoutes.php"; // Menggunakan BookRoutes

use app\Routes\BookRoutes; // Menggunakan BookRoutes

// Mendapatkan metode HTTP (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Mendapatkan path URL dari request
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Membuat instance dari BookRoutes untuk menangani request
$bookRoutes = new BookRoutes(); // Menggunakan BookRoutes
$bookRoutes->handle($method, $path); // Menangani rute berdasarkan metode dan path
