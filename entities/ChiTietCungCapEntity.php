<?php

class ChiTietCungCapEntity {
    private $table = "chitietphieucc";

    private $columns = array(
        "ID" => "ID",
        "SOPHIEU" => "SOPHIEU",
        "MAVPP" => "MAVPP",
        "SOLUONG" => "SOLUONG",
        "THANHTIEN" => "THANHTIEN"
    );

    public function column(string $key){
        return $this->columnName[$key];
    }

    public function table(){
        return $this->table;
    }
}