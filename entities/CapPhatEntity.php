<?php

class CapPhatEntity {
    private $table = "capphat";

    private $columns = array(
        "SOPHIEU" => "SOPHIEU",
        "NGAYCAP" => "NGAYCAP",
        "MAVPP" => "MAVPP",
        "MANV" => "MANV",
        "SOLUONG" => "SOLUONG"
    );
    
    public function column(string $key){
        return $this->columnName[$key];
    }

    public function table(){
        return $this->table;
    }
}