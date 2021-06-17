<?php

class PhieuCungCapDatabase extends Database implements DatabaseInterface {

    private $conn;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function insert($params) {
        mysqli_query(
            $this->conn,
            "INSERT INTO phieucungcap (SOPHIEU, TRANGTHAI, MANCC, NGAYDAT, NGAYGIAO) 
            VALUES(
                '".$params['sophieu']."',
                '".$params['trangthai']."',
                '".$params['mancc']."',
                NOW(),
                '".$params['ngaygiao']."')"
        );
        mysqli_commit($this->conn);
    }

    public function update($params) {
        mysqli_query(
            $this->conn, 
            "UPDATE phieucungcap SET 
            TRANGTHAI='".$params['trangthai']."',
            NGAYGIAO='".$params['ngaygiao']."',
            MANCC='".$params['mancc']."'
            WHERE SOPHIEU='".$params['sophieu']."' "
        );
        mysqli_commit($this->conn);
    }

    public function remove($params) {
        mysqli_query(
            $this->conn,
            "DELETE FROM phieucungcap WHERE SOPHIEU='".$params['sophieu']."' "
        );
        mysqli_commit($this->conn);
    }

    public function select($params) {
        $sql = isset($params['sophieu']) ?
        "
        SELECT L.*, R.THANHTIEN FROM phieucungcap AS L 
        LEFT JOIN ( SELECT SOPHIEU, SUM(THANHTIEN) AS THANHTIEN FROM chitietphieucc GROUP BY SOPHIEU ) 
        AS R ON L.SOPHIEU = R.SOPHIEU WHERE L.SOPHIEU = '".$params['sophieu']."';
        ": 
        "
        SELECT L.*, R.THANHTIEN FROM phieucungcap AS L 
        LEFT JOIN ( SELECT SOPHIEU, SUM(THANHTIEN) AS THANHTIEN FROM chitietphieucc GROUP BY SOPHIEU ) 
        AS R ON L.SOPHIEU = R.SOPHIEU;
        ";
        $result = mysqli_query($this->conn, $sql);
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function insertDetail($params) {
        mysqli_query(
            $this->conn,
            "INSERT INTO chitietphieucc (SOPHIEU, MAVPP, SOLUONG, THANHTIEN) 
            VALUES(
                '".$params['sophieu']."',
                '".$params['mavpp']."',
                '".$params['soluong']."',
                '".$params['thanhtien']."')"
        );
        mysqli_commit($this->conn);
        $result = mysqli_query($this->conn, "SELECT ID FROM chitietphieucc ORDER BY ID DESC LIMIT 1");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function updateDetail($params) {
        mysqli_query(
            $this->conn,
            "UPDATE chitietphieucc SET
            SOLUONG=".$params['soluong'].",
            THANHTIEN=".$params['thanhtien']."
            WHERE ID=".$params['id']." "
        );
        mysqli_commit($this->conn);
    }

    public function removeDetail($params) {
        mysqli_query(
            $this->conn,
            "DELETE FROM chitietphieucc 
            WHERE ID='".$params['id']."' "
        );
        mysqli_commit($this->conn);
    }

    public function selectDetail($params) {
        $data = array();
        $sql = "";

        if (!isset($params['sophieu']) && !isset($params['id'])) {
            return $data;
        }

        if (isset($params['sophieu'])) {
            $sql = "
            SELECT CT.ID, CT.SOPHIEU, CT.MAVPP, CT.SOLUONG, CT.THANHTIEN, V.TENVPP, 
            V.DVT FROM chitietphieucc CT, vanphongpham V WHERE CT.MAVPP = V.MAVPP 
            AND CT.SOPHIEU = '".$params['sophieu']."'
            ";
        }

        if (isset($params['id'])) {
            $sql = "
            SELECT CT.ID, CT.SOPHIEU, CT.MAVPP, CT.SOLUONG, CT.THANHTIEN, V.TENVPP, 
            V.DVT FROM chitietphieucc CT, vanphongpham V WHERE CT.MAVPP = V.MAVPP 
            AND CT.ID = '".$params['id']."'
            ";
        }
        
        $result = mysqli_query($this->conn, $sql);
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function isExistID($sophieu) {
        $result = mysqli_query($this->conn,"SELECT * FROM phieucungcap WHERE 
        SOPHIEU= '".$sophieu."' ");
        return mysqli_num_rows($result) == 0 ? false : true;
    }

    public function isOpening() {
        $result = mysqli_query($this->conn,"SELECT * FROM phieucungcap WHERE 
        TRANGTHAI='OPENING' ");
        return mysqli_num_rows($result) == 0 ? false : true;
    }

    public function getEmailInfo($sophieu) {
        $sql = "
        SELECT P.SOPHIEU, P.MANCC, N.TENNCC, N.EMAIL, P.NGAYGIAO FROM phieucungcap P, 
        nhacungcap N WHERE P.MANCC = N.MANCC AND P.SOPHIEU='".$sophieu."'";
        $result = mysqli_query($this->conn, $sql);
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }
}