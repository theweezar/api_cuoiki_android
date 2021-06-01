<?php

class NhaCungCapEntity {
    private $table = "nhacungcap";

    private $columns = array(
        "MANCC" => "MANCC",
        "TENNCC" => "TENNCC",
        "EMAIL" => "EMAIL"
    );
    
    public function column(string $key){
        return $this->columnName[$key];
    }

    public function table(){
        return $this->table;
    }
}