<?php

class Request {
    public static function dump($controller = null, $method = null){
        $argv = array(
            'controller' => $controller,
            'method' => $method
        );
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $argv['request_method'] = 'GET';
            $argv['params'] = $_GET;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $argv['request_method'] = 'POST';
            $argv['params'] = $_POST;
        }
        return [$argv];
    }
}