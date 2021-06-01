<?php 

class PhieuCungCapEntity {
    private $table = "phieucungcap";

    private $columns = array(
        "SOPHIEU" => "SOPHIEU",
        "TRANGTHAI" => "TRANGTHAI"
    );
    
    public function column(string $key){
        return $this->columnName[$key];
    }

    public function table(){
        return $this->table;
    }
}