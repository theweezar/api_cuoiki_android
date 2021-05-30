<?php

class NhanVienDatabase extends Database implements DatabaseInterface {

    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function insert($params) {

    }

    public function update($params) {

    }

    public function remove($params) {

    }

    public function select($params) {
        $result = mysqli_query($this->conn,"SELECT * FROM nhanvien");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }
}