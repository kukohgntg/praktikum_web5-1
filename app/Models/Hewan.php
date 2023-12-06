<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Hewan extends DatabaseConfig
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

    // menampilkan semua data hewan
    public function findAll()
    {
        $sql = "SELECT * FROM Hewan";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // menampilkan semua data hewan dengan informasi jenis makanan
    public function findAllWithJenisMakanan()
    {
        $sql = "SELECT Hewan.*, JenisMakanan.nama AS jenis_makanan FROM Hewan
                JOIN JenisMakanan ON Hewan.jenis_makanan_id = JenisMakanan.id_jenis";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // menampilkan data hewan dengan id
    public function findById($id)
    {
        $sql = "SELECT * FROM Hewan WHERE id_hewan = ?";
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

    // menampilkan data hewan berdasarkan jenis makanan
    public function findByJenisMakanan($jenisMakananId)
    {
        $sql = "SELECT Hewan.*, JenisMakanan.nama AS jenis_makanan FROM Hewan
                JOIN JenisMakanan ON Hewan.jenis_makanan_id = JenisMakanan.id_jenis
                WHERE JenisMakanan.id_jenis = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $jenisMakananId);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // insert data hewan
    public function create($data)
    {
        $namaHewan = $data['nama_hewan'];
        $jenisMakananId = $data['jenis_makanan_id'];
        $query = "INSERT INTO Hewan (nama, jenis_makanan_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $namaHewan, $jenisMakananId);
        $stmt->execute();
        $this->conn->close();
    }

    // update data hewan dengan id
    public function update($data, $id)
    {
        $namaHewan = $data['nama_hewan'];
        $jenisMakananId = $data['jenis_makanan_id'];
        $query = "UPDATE Hewan SET nama = ?, jenis_makanan_id = ? WHERE id_hewan = ?";
        $stmt = $this->conn->prepare($query);
        //s=string untuk nama_hewan, i=integer untuk jenis_makanan_id dan id_hewan
        $stmt->bind_param("sii", $namaHewan, $jenisMakananId, $id);
        $stmt->execute();
        $this->conn->close();
    }

    // hapus data hewan dengan id
    public function destroy($id)
    {
        $query = "DELETE FROM Hewan WHERE id_hewan = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}
