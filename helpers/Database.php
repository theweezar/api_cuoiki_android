<?php
/**
 * Contain all the configs, table, columns name and method getConnection()
 */
class Database {

    protected $HOST = "localhost";
    protected $USERNAME = "root";
    protected $PASSWORD = "";
    protected $DATABASENAME = "cuoiki_android";

    protected function getConnection(){
        return mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASENAME);
    }
}