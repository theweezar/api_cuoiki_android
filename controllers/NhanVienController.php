<?php

class NhanVienController {
    public function show($argv) {
        $nhanvienDb = new NhanVienDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $nhanvienDb->select($argv['params']),
            'success' => true
        ));
    }

    public function insert($argv) {
        if ($argv['request_method'] === 'POST') {
            $nhanvienDb = new NhanVienDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if (!$nhanvienDb->isExistID($argv['params']['manv'])){
                $nhanvienDb->insert($argv['params']);
                Response::json(array(
                    'request' => $argv,
                    'success' => true
                ));
            }
            else {
                Response::json(array(
                    'success' => false,
                    'message' => 'MANV is exist'
                ));
            }
        }
        else {
            Response::render('insert.html');
        }
    }

    public function update($argv) {
        if ($argv['request_method'] === 'POST') {
            $nhanvienDb = new NhanVienDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $nhanvienDb->update($argv['params']);
            Response::json(array(
                'request' => $argv,
                'success' => true
            ));
        }
        else {
            Response::json(array(
                'success' => false,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }

    public function remove($argv) {
        if ($argv['request_method'] === 'POST') {
            $nhanvienDb = new NhanVienDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $nhanvienDb->remove($argv['params']);
            Response::json(array(
                'request' => $argv,
                'success' => true
            ));
        }
    }
}