<?php

namespace app\Routes;

include "app/Controller/BookController.php";

use app\Controller\BookController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

class BookRoutes {
    public function handle($method, $path) {
        // JIKA REQUEST METHOD GET DAN PATH SAMA DENGAN '/api/book'
        if ($method == "GET" && $path == '/api/book') {
            $controller = new BookController();
            echo $controller->index();
        }

        // JIKA REQUEST METHOD GET DAN PATH SAMA DENGAN '/api/book/{id}'
        if ($method == "GET" && strpos($path, "/api/book/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new BookController();
            echo $controller->getById($id);
        }

        // JIKA REQUEST METHOD POST DAN PATH SAMA DENGAN '/api/book'
        if ($method == "POST" && $path == "/api/book") {
            $controller = new BookController();
            echo $controller->insert();  // Tidak perlu perbaikan, sudah benar
        }

        // JIKA REQUEST METHOD PUT DAN PATH SAMA DENGAN '/api/book/{id}'
        if ($method == "PUT" && strpos($path, "/api/book/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            // Menangani input JSON untuk update
            $controller = new BookController();
            echo $controller->update($id);  // Method update sudah menangani data JSON
        }

        // JIKA REQUEST METHOD DELETE DAN PATH SAMA DENGAN '/api/book/{id}'
        if ($method == "DELETE" && strpos($path, "/api/book/") === 0) {
            $pathParts = explode("/", $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new BookController();
            echo $controller->delete($id);
        }
    }
}
