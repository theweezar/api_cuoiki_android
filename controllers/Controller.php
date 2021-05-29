<?php

class Controller{
    protected function render(string $view, $view_data = array()){
        require($_SERVER['DOCUMENT_ROOT'].'/../views/'.$view);
    }
}