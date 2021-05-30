<?php
/**
 * Server will handle all the requests coming
 */
class Server {

    /**
     * Controller object
     */
    private $controller;
    /**
     * Start server
     */
    public function execute(){
        // echo "Server is running...";
        if(isset($_GET['url'])){
            $url = explode('-',filter_var(rtrim($_GET['url']), FILTER_SANITIZE_URL));
            $controller_name = $url[0];
            $method_name = $url[1];
            $controller_path = $_SERVER['DOCUMENT_ROOT'].'/../controllers/'.$controller_name.'.php';
            if (file_exists($controller_path)){
                require($controller_path);
                $this->controller = new $controller_name;
                if (!method_exists($this->controller, $method_name)){
                    echo "Method not found";
                }
                else {
                    call_user_func_array(
                        [$this->controller, $method_name], 
                        Request::dump(get_class($this->controller), $method_name)
                    );
                }
            }
            else {
                echo "Controller not found";
            }
        }
    }
}