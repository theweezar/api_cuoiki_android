<?php

class VanPhongPhamController {
    public function show($argv) {
        $vppDb = new VanPhongPhamDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $vppDb->select($argv)
        ));
    }
}