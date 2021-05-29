<?php

class PhongBanController extends Controller {

    public function home(){
        echo "method home in PhongBanController";
    }

    public function test_form(){
        echo "<p>Test action to form</p>";
        echo "<b>GET: </b>";
        echo "<p>".var_dump($_GET)."</p>";
        echo "<b>POST: </b>";
        echo "<p>".var_dump($_POST)."</p>";
        $this->render('form.html');
    }

    public function show(){
        $phongbanDb = new PhongBanDatabase();
        header('Content-Type: application/json');
        echo json_encode($phongbanDb->select());
    }
}