<?php

class CapPhatController {
    public function show($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->select($argv),
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
}