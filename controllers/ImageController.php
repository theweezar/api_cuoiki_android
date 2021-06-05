<?php

class ImageController {
    // pmfbdjvhoa.jpg
    public function get($argv) {
        $imageType = strtolower(pathinfo($argv['params']['hinh'], PATHINFO_EXTENSION));
        $image = file_get_contents(realpath(dirname(getcwd()))."/storage/".$argv['params']['hinh']);
        header("Content-type: image/".$imageType);
        echo $image;
    }
}