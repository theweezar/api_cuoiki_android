<?php

class PhieuCungCapController {
    public function show($argv) {
        $phieuccDb = new PhieuCungCapDatabase();

        $phieuArray = array();
        $phieucc = $phieuccDb->select($argv);

        Response::json(array(
            'request' => $argv,
            'viewData' => $phieucc,
            'success' => true
        ));
    }

    public function showDetail($argv) {
        $phieuccDb = new PhieuCungCapDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $phieuccDb->selectDetail($argv['params']),
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

            $newId = $phieuccDb->insertDetail($argv['params']);

            Response::json(array(
                'request' => $argv,
                'success' => true,
                'ID' => count($newId) !== 0 ? $newId[0]['ID'] : null
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
            // ======================== //
            if (strcmp($argv['params']['trangthai'], 'CONFIRMED')) {
                $emailInfo = $phieuccDb->getEmailInfo($argv['params']['sophieu']);
                $chitietcc = $phieuccDb->selectDetail($argv['params']);
                $tongcong = $phieuccDb->select($argv)[0]['THANHTIEN'];
                $emailTo = $emailInfo[0]['EMAIL'];
                $nameTo = $emailInfo[0]['TENNCC'];
                
                ob_start();
                Response::render('table.php', array(
                    'ngaygiao' => $emailInfo[0]['NGAYGIAO'],
                    'sophieu' => $emailInfo[0]['SOPHIEU'],
                    'chitietcc' => $chitietcc,
                    'tongcong' => $tongcong
                ));
                $htmlContent = ob_get_clean();
                sendMail($emailTo, $nameTo, "Phieu dat hang", $htmlContent);
                Response::json(array(
                    'request' => $argv,
                    'success' => true,
                    'emailInfo' => $emailInfo,
                    'chitietcc' => $chitietcc
                ));
            }
            else if (strcmp($argv['params']['trangthai'], 'DELIVERIED')) {
                $chitietcc = $phieuccDb->selectDetail($argv['params']['sophieu']);

            }
            else Response::json(array(
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

    public function testConfirmed($argv) {
        $phieuccDb = new PhieuCungCapDatabase();
        $argv['params'] = checkInputParams($argv['params']);
        // ======================== //
        $emailInfo = $phieuccDb->getEmailInfo($argv['params']['sophieu']);
        $chitietcc = $phieuccDb->selectDetail($argv['params']);
        $tongcong = $phieuccDb->select($argv)[0]['THANHTIEN'];
        $emailTo = $emailInfo[0]['EMAIL'];
        $nameTo = $emailInfo[0]['TENNCC'];
        
        ob_start();
        Response::render('phieucungcap.php', array(
            'ngaygiao' => $emailInfo[0]['NGAYGIAO'],
            'sophieu' => $emailInfo[0]['SOPHIEU'],
            'chitietcc' => $chitietcc,
            'tongcong' => $tongcong
        ));
        $htmlContent = ob_get_clean();
        sendMail($emailTo, $nameTo, "Phieu dat hang", $htmlContent);
    }

    public function testDeliveried($argv) {
        $phieuccDb = new PhieuCungCapDatabase();
        $vppDb = new VanPhongPhamDatabase();
        $argv['params'] = checkInputParams($argv['params']);
        // ======================== //
        $chitietcc = $phieuccDb->selectDetail($argv['params']);
        foreach ($chitietcc as $key => $chitiet) {
            $vppDb->updateQuantity($chitiet);
        }
        Response::json(array(
            'request' => $argv,
            'success' => true,
            'chitietcc' => $chitietcc
        ));
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