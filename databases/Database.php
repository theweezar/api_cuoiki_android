<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/**
 * Contain all the configs, table, columns name and method getConnection()
 */
class Database {

    protected $HOST = "localhost";
    protected $USERNAME = "root";
    protected $PASSWORD = "";
    protected $DATABASENAME = "cuoiki_android";

    protected $phongbanTable = 'phongban';

    protected $nhanvienTable = 'nhanvien';

    protected $vanphongphamTable = 'vanphongpham';

    protected $capphatTable = 'capphat';

    protected $nhacungcapTable = 'nhacungcap';

    protected $phieucungcapTable = 'phieucungcap';

    protected $ctphieuccTable = 'chitietphieucc';

    protected function getConnection(){
        return mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DATABASENAME);
    }
}