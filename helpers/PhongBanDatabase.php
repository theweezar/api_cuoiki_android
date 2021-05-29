<?php

class PhongBanDatabase extends Database implements Helper{
    
    private $connection;

    public function __construct() {
        $this->connection = $this->getConnection();
    }

    public function insert(){

    }

    public function update(){

    }

    public function remove(){

    }

    public function select() {
        $result = mysqli_query($this->connection,"SELECT * FROM phongban");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }
}