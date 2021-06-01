<?php

function checkInput($string) {
    $string = htmlspecialchars(stripslashes(trim($string)));
    return strlen($string) == 0 ? null : $string;
}

function checkInputParams($params) {
    foreach (array_keys($params) as $key) {
        $params[$key] = strtoupper(checkInput($params[$key]));
    }
    return $params;
}