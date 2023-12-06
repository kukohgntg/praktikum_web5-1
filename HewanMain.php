<?php
header("Content-Type: application/json; charset=UTF-8");
include "app/Routes/HewanRoutes.php";

use app\Routes\HewanRoutes;

// menangkap request method
$method = $_SERVER['REQUEST_METHOD'];
// menangkap request path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// memanggil route
$hewanRoute = new HewanRoutes();
$hewanRoute->handle($method, $path);
