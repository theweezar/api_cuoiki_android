<?php 

class NhanVienEntity {
    private $table = "NHANVIEN";

    private $columns = array(
        "MANV" => "MANV",
        "HOTEN" => "HOTEN",
        "NGAYSINH" => "NGAYSINH",
        "MAPB" => "MAPB",
        "EMAIL" => "EMAIL"
    );
    
    public function column(string $key){
        return $this->columnName[$key];
    }

    public function table(){
        return $this->table;
    }
}