<?php

class PhieuCungCapController {
    public function show($argv) {
        $phieuccDb = new PhieuCungCapDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $phieuccDb->select($argv)
        ));
    }

    public function insert($argv) {
        if ($argv['request_method'] === 'POST') {
            $phieuccDb = new PhieuCungCapDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if ($phieuccDb->isExistID($argv['params']['mavpp'])) {
                Response::json(array(
                    'error' => true,
                    'message' => 'MAVPP is existed'
                ));
            }
            else {
                $phieuccDb->insert($argv['params']);
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

    public function insertDetail($argv) {

    }

    public function update($argv) {

    }

    public function updateDetail($argv) {

    }

    public function remove($argv) {

    }

    public function removeDetail($argv) {

    }
}