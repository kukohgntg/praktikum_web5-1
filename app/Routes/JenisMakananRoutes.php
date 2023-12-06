<?php

namespace app\Routes;

include "app/Controller/JenisMakananController.php";

use app\Controller\JenisMakananController;

class JenisMakananRoutes
{
    public function handle($method, $path)
    {
        // jika request method get dan path sama dengan '/api/jenis-makanan/'
        if ($method === 'GET' && $path === '/api/jenis-makanan') {
            $controller = new JenisMakananController();
            echo $controller->index();
        }
        // jika request method get dan path mengandung '/api/jenis-makanan/'
        if ($method === 'GET' && strpos($path, '/api/jenis-makanan/') === 0) {
            // extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new JenisMakananController();
            echo $controller->getById($id);
        }
        // jika request method post dan path sama dengan '/api/jenis-makanan'
        if ($method === 'POST' && $path === '/api/jenis-makanan') {
            $controller = new JenisMakananController();
            echo $controller->insert();
        }
        // jika request method put dan path mengandung '/api/jenis-makanan/'
        if ($method === 'PUT' && strpos($path, '/api/jenis-makanan/') === 0) {
            // extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new JenisMakananController();
            echo $controller->update($id);
        }
        // jika request method delete dan path mengandung '/api/jenis-makanan/'
        if ($method === 'DELETE' && strpos($path, '/api/jenis-makanan/') === 0) {
            // extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new JenisMakananController();
            echo $controller->delete($id);
        }
    }
}
