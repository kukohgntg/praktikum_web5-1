<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class JenisMakanan extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {
        //koneksi ke database
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        //check koneksi
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // menampilkan semua data jenis makanan
    public function findAll()
    {
        $sql = "SELECT * FROM JenisMakanan";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // menampilkan data jenis makanan dengan id
    public function findById($id)
    {
        $sql = "SELECT * FROM JenisMakanan WHERE id_jenis = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // insert data jenis makanan
    public function create($data)
    {
        $namaJenisMakanan = $data['nama_jenis_makanan'];
        $query = "INSERT INTO JenisMakanan (nama) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $namaJenisMakanan);
        $stmt->execute();
        $this->conn->close();
    }

    // update data jenis makanan dengan id
    public function update($data, $id)
    {
        $namaJenisMakanan = $data['nama_jenis_makanan'];
        $query = "UPDATE JenisMakanan SET nama = ? WHERE id_jenis = ?";
        $stmt = $this->conn->prepare($query);
        //s=string untuk nama_jenis_makanan dan i=integer untuk id_jenis
        $stmt->bind_param("si", $namaJenisMakanan, $id);
        $stmt->execute();
        $this->conn->close();
    }

    // hapus data jenis makanan dengan id
    public function destroy($id)
    {
        $query = "DELETE FROM JenisMakanan WHERE id_jenis = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}
