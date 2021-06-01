<?php

class NhanVienDatabase extends Database implements DatabaseInterface {

    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function insert($params) {
        mysqli_query(
            $this->conn,
            "INSERT INTO nhanvien (MANV, HOTEN, NGAYSINH, MAPB, EMAIL) 
            VALUES('".$params['manv']."','".$params['hoten']."','".$params['ngaysinh']."'
            ,'".$params['mapb']."', '".$params['email']."')"
        );
        mysqli_commit($this->conn);
    }

    public function update($params) {
        mysqli_query(
            $this->conn,
            "UPDATE nhanvien SET HOTEN='".$params['hoten']."'
            , NGAYSINH='".$params['ngaysinh']."', MAPB='".$params['mapb']."', 
            EMAIL='".$params['email']."' WHERE MANV=".$params['manv']." "
        );
        mysqli_commit($this->conn);
    }

    public function remove($params) {
        mysqli_query(
            $this->conn,
            "DELETE FROM nhanvien WHERE MANV=".$params['manv'].""
        );
        mysqli_commit($this->conn);
    }

    public function select($params) {
        $result = mysqli_query($this->conn,"SELECT * FROM nhanvien");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function isExistID($manv) {
        $result = mysqli_query($this->conn,"SELECT * FROM nhanvien WHERE MANV='".$manv."'");
        return mysqli_num_rows($result) == 0 ? false : true;
    }
}