<?php

class CapPhatController {
    public function show($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->select($argv)
        ));
    }

    public function thongKeCau2a($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2a($argv)
        ));
    }
    
    public function thongKeCau2b($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2b($argv)
        ));
    }

    public function thongKeCau2c($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2c($argv)
        ));
    }

    public function thongKeCau2d($argv) {
        $capphatDb = new CapPhatDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $capphatDb->thongKeCau2d($argv)
        ));
    }
}