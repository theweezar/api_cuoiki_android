<?php

class PhongBanDatabase extends Database implements DatabaseInterface {
    
    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function insert($params){
        mysqli_query(
            $this->conn,
            "INSERT INTO phongban (MAPB, TENPB) VALUES('".$params['mapb']."','".$params['tenpb']."')"
        );
        mysqli_commit($this->conn);
    }

    public function update($params){
        mysqli_query(
            $this->conn,
            "UPDATE phongban SET TENPB='".$params['tenpb']."' WHERE MAPB='".$params['mapb']."' "
        );
        mysqli_commit($this->conn);
    }

    public function remove($params){
        mysqli_query(
            $this->conn,
            "DELETE FROM phongban WHERE MAPB='".$params['mapb']."'"
        );
        mysqli_commit($this->conn);
    }

    public function select($params) {
        $result = mysqli_query($this->conn,"SELECT * FROM phongban");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }
    
    public function isExistID($mapb) {
        $result = mysqli_query($this->conn,"SELECT * FROM phongban WHERE 
        MAPB= '".$mapb."' ");
        return mysqli_num_rows($result) == 0 ? false : true;
    }

    
    public function isExistName($tenpb) {
        $result = mysqli_query($this->conn,"SELECT * FROM phongban WHERE 
        TENPB= '".$tenpb."' ");
        return mysqli_num_rows($result) == 0 ? false : true;
    }
}