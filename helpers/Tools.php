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

function getRandomString($length) {
    $str = "";
    for($i = 0; $i < $length; $i+=1){
        $str = $str.chr(rand(97,122));
    }
    return $str;
}

function convertKeyToLowerCase($object) {
    foreach (array_keys($object) as $key) {
        $object[strtolower($key)] = $object[$key];
        // unset($object[$key]);
    }
    return $object;
}