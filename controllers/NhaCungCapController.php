<?php

class NhaCungCapController {
    public function show($argv) {
        $nccDb = new NhaCungCapDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $nccDb->select($argv['params']),
            'success' => true
        ));
    }
}