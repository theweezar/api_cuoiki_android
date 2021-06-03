<?php

class VanPhongPhamController {
    public function show($argv) {
        $vppDb = new VanPhongPhamDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $vppDb->select($argv)
        ));
    }

    public function insert($argv) {
        if ($argv['request_method'] === 'POST') {
            $vppDb = new VanPhongPhamDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if ($vppDb->isExistID($argv['params']['mavpp'])) {
                Response::json(array(
                    'error' => true,
                    'message' => 'MAVPP is existed'
                ));
            }
            else if ($vppDb->isExistName($argv['params']['tenvpp'])) {
                Response::json(array(
                    'error' => true,
                    'message' => 'TENVPP is existed'
                ));
            }
            else {
                $vppDb->insert($argv['params']);
                Response::json(array(
                    'request' => $argv,
                    'success' => true
                ));
            }
        }
        else {
            Response::render('insert.html');
        }
    }

    public function update($argv) {
        if ($argv['request_method'] === 'POST') {
            $vppDb = new VanPhongPhamDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if ($vppDb->isExistName($argv['params']['tenvpp'])) {
                Response::json(array(
                    'error' => true,
                    'message' => 'TENVPP is existed'
                ));
            }
            else {
                $vppDb->update($argv['params']);
                Response::json(array(
                    'request' => $argv,
                    'success' => true
                ));
            }
        }
        else {
            Response::json(array(
                'error' => true,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }

    public function remove($argv) {
        if ($argv['request_method'] === 'POST'){
            $vppDb = new VanPhongPhamDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $vppDb->remove($argv['params']);
            Response::json(array(
                'request' => $argv,
                'success' => true
            ));
        }
        else {
            Response::json(array(
                'error' => true,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }
}