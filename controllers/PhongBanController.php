<?php

class PhongBanController {

    public function test_form(){
        echo "<p>Test action to form</p>";
        echo "<b>GET: </b>";
        echo "<p>".var_dump($_GET)."</p>";
        echo "<b>POST: </b>";
        echo "<p>".var_dump($_POST)."</p>";
        Response::render('form.html');
    }

    public function show($argv){
        $phongbanDb = new PhongBanDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $phongbanDb->select($argv['params']),
            'success' => true
        ));
    }

    public function insert($argv){
        if ($argv['request_method'] === 'POST'){
            $phongbanDb = new PhongBanDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if ($phongbanDb->isExistID($argv['params']['mapb'])) {
                Response::json(array(
                    'success' => false,
                    'message' => 'MAPB is existed'
                ));
            }
            else if ($phongbanDb->isExistName($argv['params']['tenpb'])) {
                Response::json(array(
                    'success' => false,
                    'message' => 'TENVPP is exist'
                ));
            }
            else {
                $phongbanDb->insert($argv['params']);
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
        if ($argv['request_method'] === 'POST'){
            $phongbanDb = new PhongBanDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if ($phongbanDb->isExistName($argv['params']['tenpb'])) {
                Response::json(array(
                    'success' => false,
                    'message' => 'TENVPP is exist'
                ));
            }
            else {
                $phongbanDb->update($argv['params']);
                Response::json(array(
                    'request' => $argv,
                    'success' => true
                ));
            }
        }
        else {
            Response::json(array(
                'success' => false,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }

    public function remove($argv) {
        if ($argv['request_method'] === 'POST'){
            $phongbanDb = new PhongBanDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            $phongbanDb->remove($argv['params']);
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
}