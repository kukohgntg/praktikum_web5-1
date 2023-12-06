<?php
header("Content-Type: application/json; charset=UTF-8");
include "app/Routes/JenisMakananRoutes.php";

use app\Routes\JenisMakananRoutes;

// menangkap request method
$method = $_SERVER['REQUEST_METHOD'];
// menangkap request path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// memanggil route
$jenisMakananRoute = new JenisMakananRoutes();
$jenisMakananRoute->handle($method, $path);
