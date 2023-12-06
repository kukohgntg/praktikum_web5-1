<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Hewan.php";

use app\Models\Hewan;
use app\Traits\ApiResponseFormatter;

class HewanController
{
    // menggunakan trait
    use ApiResponseFormatter;

    public function index()
    {
        // object model hewan yang sudah dibuat
        $hewanModel = new Hewan();
        // memanggil fungsi get all hewan
        $response = $hewanModel->findAll();
        // mengembalikan respon dengan memformat terlebih dahulu
        return $this->apiResponse(200, "success", $response);
    }

    public function getById($id)
    {
        $hewanModel = new Hewan();
        $response = $hewanModel->findById($id);
        return $this->apiResponse(200, "success", $response);
    }

    public function getAllWithJenisMakanan()
    {
        // object model hewan yang sudah dibuat
        $hewanModel = new Hewan();
        // memanggil fungsi get all hewan dengan informasi jenis makanan
        $response = $hewanModel->findAllWithJenisMakanan();
        // mengembalikan respon dengan memformat terlebih dahulu
        return $this->apiResponse(200, "success", $response);
    }

    public function getByJenisMakanan($jenisMakananId)
    {
        $hewanModel = new Hewan();
        $response = $hewanModel->findByJenisMakanan($jenisMakananId);
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
        $hewanModel = new Hewan();
        $response = $hewanModel->create(["nama_hewan" => $inputData['nama_hewan'], "jenis_makanan_id" => $inputData['jenis_makanan_id']]);
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
        $hewanModel = new Hewan();
        $response = $hewanModel->update(["nama_hewan" => $inputData['nama_hewan'], "jenis_makanan_id" => $inputData['jenis_makanan_id']], $id);
        return $this->apiResponse(200, "success", $response);
    }

    public function delete($id)
    {
        $hewanModel = new Hewan();
        $response = $hewanModel->destroy($id);
        return $this->apiResponse(200, "success", $response);
    }
}
