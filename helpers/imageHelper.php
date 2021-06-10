<?php

function verifyImageFile($image) {
    return $image['size'] < 5 * 1024 * 1024 ? true : false;
}

function saveImageFile($image) {
    $success = false;
    $fileName = null;
    $message = null;

    if (verifyImageFile($image)) {
        $targetDir = realpath(dirname(getcwd()))."/storage/";
        $imageType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $fileName = getRandomString(10).'.'.$imageType;
        $targetFile = $targetDir.$fileName;

        $success = move_uploaded_file($image['tmp_name'], $targetFile);
        $message = $success ? 'Uploaded image successfully.' : 'There are some error when upload image.';
    }
    else {
        $message = 'Image size is too big to upload.';
    }

    return array(
        'success' => $success,
        'fileName' => $fileName,
        'message' => $message,
    );
}

function removeImageFile($imageFileName) {
    $targetDir = realpath(dirname(getcwd()))."/storage/";
    $targetFile = $targetDir.$imageFileName;
    unlink($targetFile);
}