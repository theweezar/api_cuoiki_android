<?php

class PhongBanEntity {
    public $table = "phongban";

    public $columns = array(
        "MAPB" => "MAPB",
        "TENPB" => "TENPB"
    );
    
    public function column(string $key){
        return $this->columns[$key];
    }

    public function table(){
        return $this->table;
    }
}