<?php

class PhieuCungCapController {
    public function show($argv) {
        $phieuccDb = new PhieuCungCapDatabase();

        $phieuArray = array();
        $phieucc = $phieuccDb->select($argv);
        
        foreach ($phieucc as $key => $phieu) {
            $phieu['CHITIET'] = $phieuccDb->selectDetail($phieu['SOPHIEU']);
            array_push($phieuArray, $phieu);
        }

        Response::json(array(
            'request' => $argv,
            'viewData' => $phieuArray,
            'success' => true
        ));
    }

    public function insert($argv) {
        if ($argv['request_method'] === 'POST') {
            $phieuccDb = new PhieuCungCapDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if ($phieuccDb->isOpening()) {
                Response::json(array(
                    'success' => false,
                    'message' => 'THERE IS ONE CART OPENING'
                ));
            }
            else if ($phieuccDb->isExistID($argv['params']['sophieu'])) {
                Response::json(array(
                    'success' => false,
                    'message' => 'SOPHIEU is existed'
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
        if ($argv['request_method'] === 'POST') {
            $phieuccDb = new PhieuCungCapDatabase();
            $vppDb = new VanPhongPhamDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $argv['params']['soluong'] = 1;

            $vpp = $vppDb->select($argv['params']);
            $thanhtien = intval($argv['params']['soluong']) * intval($vpp[0]['GIANHAP']);

            $argv['params']['thanhtien'] = $thanhtien;

            $phieuccDb->insertDetail($argv['params']);
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

    public function update($argv) {
        if ($argv['request_method'] === 'POST') {
            $phieuccDb = new PhieuCungCapDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $phieuccDb->update($argv['params']);
        }
        else {
            Response::json(array(
                'success' => false,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }

    public function updateDetail($argv) {
        if ($argv['request_method'] === 'POST') {
            $phieuccDb = new PhieuCungCapDatabase();
            $vppDb = new VanPhongPhamDatabase();
            $argv['params'] = checkInputParams($argv['params']);

            $vpp = $vppDb->select($argv['params']);
            $thanhtien = intval($argv['params']['soluong']) * intval($vpp[0]['GIANHAP']);

            $argv['params']['thanhtien'] = $thanhtien;

            $phieuccDb->updateDetail($argv['params']);

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
            $phieuccDb = new PhieuCungCapDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $phieuccDb->remove($argv['params']);
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

    public function removeDetail($argv) {
        if ($argv['request_method'] === 'POST') {
            $phieuccDb = new PhieuCungCapDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $phieuccDb->removeDetail($argv['params']);
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

    public function report($argv) {
        
    }

}