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
        $result = mysqli_query($this->conn,"
        SELECT L.MANV, L.HOTEN, L.MAPB, R.TENVPP, SUM(R.SOLUONG) AS TONGSL FROM
        (SELECT * FROM NHANVIEN ) AS L 
        JOIN 
        (SELECT CP.MANV, VPP.MAVPP, VPP.TENVPP, CP.SOLUONG from CAPPHAT CP join VANPHONGPHAM VPP on CP.maVPP = VPP.maVPP ) as R
        ON L.MANV = R.MANV
        WHERE R.TENVPP = 'Giấy A4'
        GROUP BY L.MANV
        ORDER BY TONGSL DESC
        LIMIT 2
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }
    
    public function thongKeCau2b() {
        $result = mysqli_query($this->conn,"
        SELECT DISTINCT CP.MAVPP, VPP.TENVPP, CP.NGAYCAP FROM
        ( SELECT L.MAVPP, L.NGAYCAP FROM
        ( SELECT MAVPP, NGAYCAP FROM CAPPHAT ) AS L
        JOIN
        ( SELECT MAVPP, NGAYCAP, COUNT(NGAYCAP) AS SOLUONG FROM CAPPHAT GROUP BY NGAYCAP
        HAVING COUNT(NGAYCAP) > 1 ) AS R
        WHERE  L.NGAYCAP = R.NGAYCAP ) AS CP
        JOIN VANPHONGPHAM VPP
        ON CP.MAVPP = VPP.MAVPP
        ORDER BY CP.NGAYCAP
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function thongKeCau2c() {
        $result = mysqli_query($this->conn,"
        SELECT NV.MANV, NV.HOTEN, NV.NGAYSINH , PB.TENPB FROM NHANVIEN NV JOIN PHONGBAN PB
        ON NV.MAPB = PB.MAPB
        WHERE MANV NOT IN
        (SELECT MANV FROM
        (SELECT MANV, NGAYCAP FROM CAPPHAT WHERE NGAYCAP BETWEEN '2018-01-01' AND '2018-12-31' ) AS B)
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function thongKeCau2d() {
        $result = mysqli_query($this->conn,"
        SELECT L.MAPB, L.TENPB , COALESCE(SUM(R.SOLUONG), 0 ) AS SOLUONG FROM
        PHONGBAN AS L LEFT JOIN
        (SELECT CP.*,NV.MAPB FROM 
        CAPPHAT CP JOIN NHANVIEN NV ON CP.MANV = NV.MANV) AS R
        ON L.MAPB = R.MAPB
        GROUP BY L.MAPB
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function thongKeDefault() {
        $result = mysqli_query($this->conn,"
        SELECT B.TENVPP, A.MAPB , A.TENPB, A.TONGSL FROM
        (SELECT * FROM vanphongpham) as B LEFT JOIN
        (SELECT CP.SOPHIEU, CP.NGAYCAP, NV.MANV, NV.HOTEN, PB.MAPB ,PB.TENPB, VPP.MAVPP, VPP.TENVPP, SUM(CP.SOLUONG) AS TONGSL FROM
        capphat CP, nhanvien NV, phongban PB, vanphongpham VPP
        WHERE CP.MAVPP = VPP.MAVPP
        AND CP.MANV = NV.MANV
        AND NV.MAPB = PB.MAPB
        AND PB.MAPB = 'PB01'
        GROUP BY CP.MAVPP) as A
        ON A.MAVPP = B.MAVPP
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function selectWithVPPandNVwherePB(string $mapb) {
        $result = mysqli_query($this->conn,"
        SELECT B.TENVPP, A.MAPB , A.TENPB, A.TONGSL FROM
        (SELECT * FROM vanphongpham) as B LEFT JOIN
        (SELECT CP.SOPHIEU, CP.NGAYCAP, NV.MANV, NV.HOTEN, PB.MAPB ,PB.TENPB, VPP.MAVPP, VPP.TENVPP, 
        SUM(CP.SOLUONG) AS TONGSL FROM
        capphat CP, nhanvien NV, phongban PB, vanphongpham VPP
        WHERE CP.MAVPP = VPP.MAVPP
        AND CP.MANV = NV.MANV
        AND NV.MAPB = PB.MAPB
        AND PB.MAPB = '".$mapb."'
        GROUP BY CP.MAVPP) as A
        ON A.MAVPP = B.MAVPP
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function select_listVPP_withPB(string $mapb) {
        $result = mysqli_query($this->conn,"
        SELECT DISTINCT L.MAVPP, L.TENVPP, L.DVT, L.GIANHAP*SUM(R.SOLUONG) AS TRIGIA FROM
        ( SELECT * FROM VANPHONGPHAM ) AS L
        JOIN
        (SELECT CP.MAVPP, CP.SOLUONG, CP.MANV ,NV.HOTEN,NV.MAPB FROM CAPPHAT AS CP JOIN 
        NHANVIEN AS NV ON CP.MANV = NV.MANV ) AS R
        ON L.MAVPP = R.MAVPP WHERE R.MAPB = '".$mapb."'
        GROUP BY R.MAVPP
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function select_listNV_withVPP_andPB(string $mapb, string $mavpp) {
        $result = mysqli_query($this->conn,"
        SELECT DISTINCT  R.MANV , R.HOTEN, SUM(L.SOLUONG) AS SOLUONGMUON FROM
        ( SELECT * FROM VANPHONGPHAM ) AS L
        JOIN
        (SELECT CP.MAVPP, CP.SOLUONG, CP.MANV ,NV.HOTEN,NV.MAPB FROM CAPPHAT 
        AS CP JOIN NHANVIEN AS NV ON CP.MANV = NV.MANV ) AS R
        ON L.MAVPP = R.MAVPP WHERE R.MAPB = '".$mapb."' AND R.MAVPP = '".$mavpp."'
        GROUP BY R.MAVPP, R.MANV
        ");
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function countVPPfromPB($params) { // <--- There are 2 functions in this method
        $sql = isset($params['mapb']) ? 
        "
        SELECT NV.MAPB, SUM(SOLUONG) AS TONGSL
        FROM CAPPHAT CP JOIN NHANVIEN NV
        ON CP.MANV = NV.MANV
        AND NV.MAPB = 'PB01'
        GROUP BY MAPB
        " : 
        "
        SELECT L.TENPB, COALESCE(SUM(R.SOLUONG), 0 ) AS SOLUONG FROM
        PHONGBAN AS L
        LEFT JOIN
        (SELECT CP.*,NV.MAPB FROM CAPPHAT CP JOIN NHANVIEN NV ON CP.MANV = NV.MANV) AS R
        ON L.MAPB = R.MAPB GROUP BY L.MAPB
        ";
        $result = mysqli_query($this->conn, $sql);
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }

    public function baocaoQuery($params) { // <--- There are 2 functions in this method
        $sql = "";
        
        if (isset($params['mapb'])) {
            $sql = "
            SELECT BC.SOPHIEU,BC.MANV,BC.NGAYCAP,BC.TENVPP,BC.TRIGIA FROM (SELECT R.SOPHIEU, R.NGAYCAP, R.TENVPP, R.TRIGIA, L.MANV, L.MAPB FROM
            (SELECT NV.*, PB.TENPB FROM NHANVIEN NV JOIN PHONGBAN PB ON NV.MAPB = PB.MAPB ) AS L
            JOIN
            (SELECT CP.SOPHIEU, CP.NGAYCAP, VPP.TENVPP, CP.SOLUONG*VPP.GIANHAP AS TRIGIA ,CP.MANV
            FROM CAPPHAT CP JOIN VANPHONGPHAM VPP
            ON CP.MAVPP = VPP.MAVPP) AS R
            ON L.MANV = R.MANV) AS BC WHERE BC.MAPB = '".$params['mapb']."'
            ";
        }

        if (isset($params['manv'])) {
            $sql = "
            SELECT (@STT:=@STT+1) as STT, SOPHIEU, NGAYCAP, TENVPP, TRIGIA FROM 
            (SELECT CP.SOPHIEU, NGAYCAP, TENVPP, CP.SOLUONG * GIANHAP AS TRIGIA, MANV
            FROM CAPPHAT CP JOIN VANPHONGPHAM VPP ON CP.MAVPP = VPP.MAVPP 
            WHERE CP.MANV = '".$params['manv']."') AS A
            CROSS JOIN (SELECT @STT := 0) AS D
            ";
        }

        if (strlen($sql) === 0) {
            return array();
        }

        $result = mysqli_query($this->conn, $sql);
        $data = array();
        for ($i = 0; $i < mysqli_num_rows($result); $i++){
            array_push($data, mysqli_fetch_assoc($result));
        }
        return $data;
    }
}