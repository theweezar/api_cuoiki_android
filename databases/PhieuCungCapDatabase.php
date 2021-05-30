<?php

class PhieuCungCapDatabase extends Database implements DatabaseInterface {

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
        
    }
}