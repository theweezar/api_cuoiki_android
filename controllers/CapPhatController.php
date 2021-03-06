<?php

class CapPhatController {
    public function show($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->select($argv['params']),
            'success' => true
        ));
    }

    public function thongKeCau2a($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2a(),
            'success' => true
        ));
    }
    
    public function thongKeCau2b($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2b(),
            'success' => true
        ));
    }

    public function thongKeCau2c($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2c(),
            'success' => true
        ));
    }

    public function thongKeCau2d($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2d(),
            'success' => true
        ));
    }

    public function thongKeDefault($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeDefault(),
            'success' => true
        ));
    }

    public function selectWithVPPandNVwherePB($argv) {
        // http://localhost/CapPhatController-selectWithVPPandNVwherePB?mapb=PB01
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->selectWithVPPandNVwherePB($argv['params']['mapb']),
            'success' => true
        ));
    }

    public function select_listVPP_withPB($argv) {
        // http://localhost/CapPhatController-select_listVPP_withPB?mapb=PB01
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->select_listVPP_withPB($argv['params']['mapb']),
            'success' => true
        ));
    }

    public function select_listNV_withVPP_andPB($argv) {
        // http://localhost/CapPhatController-select_listNV_withVPP_andPB?mapb=PB01&mavpp=VPP01
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->select_listNV_withVPP_andPB($argv['params']['mapb'], $argv['params']['mavpp']),
            'success' => true
        ));
    }

    public function countVPPfromPB($argv) {
        // http://localhost/CapPhatController-countVPPfromPB?mapb=PB01
        // http://localhost/CapPhatController-countVPPfromPB
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->countVPPfromPB($argv['params']),
            'success' => true
        ));
    }

    public function baocaoQuery($argv) {
        // http://localhost/CapPhatController-baocaoQuery?mapb=PB01
        // http://localhost/CapPhatController-baocaoQuery?manv=NV01
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->baocaoQuery($argv['params']),
            'success' => true
        ));
    }

    public function insert($argv) {
        $capphatDb = new CapPhatDatabase();
        $vppDb = new VanPhongPhamDatabase();
        $argv['params'] = checkInputParams($argv['params']);
        $vpp = $vppDb->select($argv['params']);

        if ($capphatDb->isExistID($argv['params']['sophieu'])) {
            Response::json(array(
                'success' => false,
                'message' => 'SOPHIEU is existed'
            ));
        }
        else if (intval($vpp[0]['SOLUONG']) < intval($argv['params']['soluong'])) {
            Response::json(array(
                'success' => false,
                'message' => 'SOLUONG in VPP is not enough'
            ));
        }
        else {
            $vpp[0]['SOLUONG'] = intval($vpp[0]['SOLUONG']) - intval($argv['params']['soluong']);
            $vppDb->update(convertKeyToLowerCase($vpp[0]));
            $capphatDb->insert($argv['params']);
            Response::json(array(
                'request' => $argv,
                'success' => true,
                'vpp' => $vpp[0]
            ));
        }
    }

    public function testConvert($argv) {
        $vppDb = new VanPhongPhamDatabase();
        $argv['params'] = checkInputParams($argv['params']);
        $vpp = $vppDb->select($argv['params']);
        Response::json(array(
            'request' => $argv,
            'success' => true,
            'vpp' => $vpp,
            'convertKey' => convertKeyToLowerCase($vpp[0]),
            's' => strtolower('A')
        ));
    }
}