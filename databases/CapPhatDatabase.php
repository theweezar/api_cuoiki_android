<?php

class CapPhatDatabase extends Database implements DatabaseInterface {

    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function insert($params) {

    }

    public function update($params) {

    }

    public function remove($params) {
        mysqli_query(
            $this->conn,
            "DELETE FROM capphat WHERE SOPHIEU='".$params['sophieu']."'"
        );
        mysqli_commit($this->conn);
    }

    public function select($params) {
        $result = mysqli_query($this->conn,"SELECT * FROM capphat");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function thongKeCau2a() {

    }
    
    public function thongKeCau2b() {
        
    }

    public function thongKeCau2c() {
        
    }

    public function thongKeCau2d() {
        
    }

    public function thongKeDefault() {
        
    }

    public function selectWithVPPandNVwherePB(string $mapb) {

    }

    public function select_listVPP_withPB(string $mapb) {

    }

    public function select_listNV_withVPP_andPB(string $mapb, string $mavpp) {

    }

    public function countVPPfromPB($params) { // <--- There are 2 functions in this method

    }

    public function BaocaoQuery($params) { // <--- There are 2 functions in this method

    }
}