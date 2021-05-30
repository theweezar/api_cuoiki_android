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
            'viewData' => $phongbanDb->select($argv)
        ));
    }

    public function insert($argv){
        if ($argv['request_method'] === 'POST'){
            $phongbanDb = new PhongBanDatabase();
            $params = $argv['params'];
            $params['mapb'] = strtoupper(checkInput($params['mapb']));
            $params['tenpb'] = strtoupper(checkInput($params['tenpb']));
            $phongbanDb->insert($params);
            Response::json(array(
                'request' => $argv,
                'success' => true
            ));
        }
        else {
            Response::render('insert.html');
            // Response::json(array(
            //     'error' => true,
            //     'message' => 'Method is not allowed'
            // ), 405);
        }
    }

    public function update($argv) {
        if ($argv['request_method'] === 'POST'){
            $phongbanDb = new PhongBanDatabase();
            $params = $argv['params'];
            $params['mapb'] = strtoupper(checkInput($params['mapb'])); 
            $params['tenpb'] = strtoupper(checkInput($params['tenpb']));
            $phongbanDb->update($params);
            Response::json(array(
                'request' => $argv,
                'success' => true
            ));
        }
        else {
            Response::json(array(
                'error' => true,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }

    public function remove($argv) {
        if ($argv['request_method'] === 'POST'){
            $phongbanDb = new PhongBanDatabase();
            $params = $argv['params'];
            $params['mapb'] = strtoupper(checkInput($params['mapb'])); 
            $params['tenpb'] = strtoupper(checkInput($params['tenpb']));
            $phongbanDb->remove($params);
            Response::json(array(
                'request' => $argv,
                'success' => true
            ));
        }
        else {
            Response::json(array(
                'error' => true,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }
}