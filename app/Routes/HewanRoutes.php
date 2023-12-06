<?php

namespace app\Routes;

include "app/Controller/HewanController.php";

use app\Controller\HewanController;

class HewanRoutes
{
    public function handle($method, $path)
    {
        // jika request method get dan path sama dengan '/api/hewan/'
        if ($method === 'GET' && $path === '/api/hewan') {
            $controller = new HewanController();
            echo $controller->index();
        }
        // jika request method get dan path mengandung '/api/hewan'
        if ($method === 'GET' && strpos($path, '/api/hewan/') === 0) {
            // extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new HewanController();
            echo $controller->getById($id);
        }
        // jika request method post dan path sama dengan '/api/hewan'
        if ($method === 'POST' && $path === '/api/hewan') {
            $controller = new HewanController();
            echo $controller->insert();
        }
        // jika request method put dan path mengandung '/api/hewan/'
        if ($method === 'PUT' && strpos($path, '/api/hewan/') === 0) {
            // extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new HewanController();
            echo $controller->update($id);
        }
        // jika request method delete dan path mengandung '/api/hewan/'
        if ($method === 'DELETE' && strpos($path, '/api/hewan/') === 0) {
            // extract id dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new HewanController();
            echo $controller->delete($id);
        }
        // jika request method get dan path sama dengan '/api/hewan-with-jenis-makanan'
        if ($method === 'GET' && $path === '/api/hewan-with-jenis-makanan') {
            $controller = new HewanController();
            echo $controller->getAllWithJenisMakanan();
        }
        // jika request method get dan path mengandung '/api/hewan-by-jenis-makanan/'
        if ($method === 'GET' && strpos($path, '/api/hewan-by-jenis-makanan/') === 0) {
            // extract id jenis makanan dari path
            $pathParts = explode('/', $path);
            $jenisMakananId = $pathParts[count($pathParts) - 1];

            $controller = new HewanController();
            echo $controller->getByJenisMakanan($jenisMakananId);
        }
    }
}
