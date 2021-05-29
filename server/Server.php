<?php
/**
 * Server will handle all the requests coming
 */
class Server {
    /**
     * Start server
     */
    public function execute(){
        // echo "Server is running...";
        if(isset($_GET['url'])){
            $url = explode('-',filter_var(rtrim($_GET['url']), FILTER_SANITIZE_URL));
            echo "<p></p><b>Url: </b> ";
            echo "<p>".var_dump($url)." </p>";
            $controller = $url[0];
            $method = $url[1];
            if (!class_exists($controller)){
                echo "Not found controller";
            }
            else {
                $controller = new $controller();
                if (!method_exists($controller, $method)){
                    echo "Not found method";
                }
                else {
                    call_user_func([$controller, $method]);
                }
            }
        }
    }
}