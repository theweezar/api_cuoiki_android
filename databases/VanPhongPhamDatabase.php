<?php

class VanPhongPhamDatabase extends Database implements DatabaseInterface {

    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function insert($params) {
        mysqli_query(
            $this->conn,
            "INSERT INTO vanphongpham (MAVPP, TENVPP, DVT, GIANHAP, HINH, SOLUONG, MANCC) 
            VALUES('".$params['mavpp']."',
                '".$params['tenvpp']."',
                '".$params['dvt']."',
                '".$params['gianhap']."',
                '".$params['hinh']."',
                ".$params['soluong'].",
                '".$params['mancc']."')"
        );
        mysqli_commit($this->conn);
    }

    public function update($params) {
        mysqli_query(
            $this->conn,
            "UPDATE vanphongpham SET 
            TENVPP='".$params['tenvpp']."',
            DVT='".$params['dvt']."',
            GIANHAP='".$params['gianhap']."',
            HINH='".$params['hinh']."',
            SOLUONG='".$params['soluong']."',
            MANCC='".$params['mancc']."' 
            WHERE MAVPP='".$params['mavpp']."' "
        );
        mysqli_commit($this->conn);
    }

    public function remove($params) {
        mysqli_query(
            $this->conn,
            "DELETE FROM vanphongpham WHERE MAVPP='".$params['mavpp']."'"
        );
        mysqli_commit($this->conn);
    }

    public function select($params) {
        $sql = isset($params['mavpp']) ? 
            "SELECT * FROM vanphongpham WHERE MAVPP='".$params['mavpp']."'" : 
            "SELECT * FROM vanphongpham" ;
        
        $result = mysqli_query($this->conn, $sql);
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function isExistID($mavpp) {
        $result = mysqli_query($this->conn,"SELECT * FROM vanphongpham WHERE 
        MAVPP= '".$mavpp."' ");
        return mysqli_num_rows($result) == 0 ? false : true;
    }

    public function isExistName($tenvpp) {
        $result = mysqli_query($this->conn,"SELECT * FROM vanphongpham WHERE 
        TENVPP= '".$tenvpp."' ");
        return mysqli_num_rows($result) == 0 ? false : true;
    }

    public function updateQuantity($params) {
        mysqli_query(
            $this->conn,
            "UPDATE vanphongpham SET 
            TENVPP='".$params['tenvpp']."',
            DVT='".$params['dvt']."',
            GIANHAP='".$params['gianhap']."',
            HINH='".$params['hinh']."',
            SOLUONG='".$params['soluong']."',
            MANCC='".$params['mancc']."' 
            WHERE MAVPP='".$params['mavpp']."' "
        );
        mysqli_commit($this->conn);
    }
}