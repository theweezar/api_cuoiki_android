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
        $phongban_db = new PhongBanDatabase();
        Response::json(array(
            'request' => $argv,
            'view_data' => $phongban_db->select($argv)
        ));
    }

    public function insert($argv){
        if ($argv['request_method'] === 'POST'){
            Response::json(array(
                'request' => $argv
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