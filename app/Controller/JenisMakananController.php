<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/JenisMakanan.php";

use app\Models\JenisMakanan;
use app\Traits\ApiResponseFormatter;

class JenisMakananController
{
    //menggunakan trait
    use ApiResponseFormatter;

    public function index()
    {
        // object model jenis makanan yang sudah dibuat
        $jenisMakananModel = new JenisMakanan();
        // memanggil fungsi get all jenis makanan
        $response = $jenisMakananModel->findAll();
        // mengembalikan respon dengan memformat terlebih dahulu
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $jenisMakananModel = new JenisMakanan();
        $response = $jenisMakananModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function insert()
    {
        // mendapatkan input json
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        // validasi input
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }
        // jika input benar
        $jenisMakananModel = new JenisMakanan();
        $response = $jenisMakananModel->create(["nama_jenis_makanan" => $inputData['nama_jenis_makanan']]);
        return $this->apiResponse(200, "success", $response);
    }

    public function update($id)
    {
        // mendapatkan input json
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        // validasi input
        if (json_last_error()) {
            return $this->apiResponse(400, "error invalid input", null);
        }
        // jika input benar
        $jenisMakananModel = new JenisMakanan();
        $response = $jenisMakananModel->update(["nama_jenis_makanan" => $inputData['nama_jenis_makanan']], $id);
        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $jenisMakananModel = new JenisMakanan();
        $response = $jenisMakananModel->destroy($id);
        return $this->apiResponse(200, "success", $response);
    }
}
