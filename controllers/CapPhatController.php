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
            'viewData' => $capphatDb->thongKeCau2a($argv),
            'success' => true
        ));
    }
    
    public function thongKeCau2b($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2b($argv),
            'success' => true
        ));
    }

    public function thongKeCau2c($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2c($argv),
            'success' => true
        ));
    }

    public function thongKeCau2d($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2d($argv),
            'success' => true
        ));
    }
}