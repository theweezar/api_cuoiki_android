<?php 

class Response {
    public static function render(string $view, $viewData = array()){
        require($_SERVER['DOCUMENT_ROOT'].'/../views/'.$view);
    }

    public static function json(array $json, int $response_code = 200){
        header('Content-Type: application/json');
        http_response_code($response_code);
        echo json_encode($json);
    }
}