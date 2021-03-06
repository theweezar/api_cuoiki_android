<?php

class VanPhongPhamController {
    public function show($argv) {
        $vppDb = new VanPhongPhamDatabase();
        Response::json(array(
            'request' => $argv,
            'viewData' => $vppDb->select($argv['params']),
            'success' => true
        ));
    }

    public function insert($argv) {
        if ($argv['request_method'] === 'POST') {
            $vppDb = new VanPhongPhamDatabase();
            $argv['params'] = checkInputParams($argv['params']);

            if ($vppDb->isExistID($argv['params']['mavpp'])) {
                Response::json(array(
                    'success' => false,
                    'message' => 'MAVPP is existed'
                ));
            }
            else if ($vppDb->isExistName($argv['params']['tenvpp'])) {
                Response::json(array(
                    'success' => false,
                    'message' => 'TENVPP is existed'
                ));
            }
            else {
                $upload = null;
                if (isset($argv['files']['hinh'])) {
                    $upload = saveImageFile($argv['files']['hinh']);
                }
                if (isset($upload) && $upload['success']) {
                    $argv['params']['hinh'] = $upload['fileName'];
                }
                else $argv['params']['hinh'] = null;
                $vppDb->insert($argv['params']);
                Response::json(array(
                    'request' => $argv,
                    'success' => true,
                    'uploadMessage' => isset($upload) ? $upload['message'] : null,
                    'fileName' => $argv['params']['hinh']
                ));
            }
        }
        else {
            Response::render('insert.html');
        }
    }

    public function update($argv) {
        if ($argv['request_method'] === 'POST') {
            $vppDb = new VanPhongPhamDatabase();
            $argv['params'] = checkInputParams($argv['params']);
			$vpp = $vppDb->select($argv['params']);
			$upload = null;
			if (isset($argv['files']['hinh'])) {
				$oldHinh = trim($vppDb->select($argv['params'])[0]['HINH']);
				if (!strcmp($oldHinh, 'NULL') && strlen($oldHinh) !== 0) {
					removeImageFile($oldHinh);
				}
				$upload = saveImageFile($argv['files']['hinh']);
			}
			if (isset($upload) && $upload['success']) {
				$argv['params']['hinh'] = $upload['fileName'];
			}
			else $argv['params']['hinh'] = null;
			$vppDb->update($argv['params']);
			Response::json(array(
				'request' => $argv,
				'success' => true,
				'uploadMessage' => isset($upload) ? $upload['message'] : null,
				'fileName' => $argv['params']['hinh']
			));
        }
        else {
            Response::json(array(
                'success' => false,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }

    public function remove($argv) {
        if ($argv['request_method'] === 'POST'){
            $vppDb = new VanPhongPhamDatabase();
            $capphatDb = new CapPhatDatabase();
            $argv['params'] = checkInputParams($argv['params']);
            if (!$capphatDb->isVppExist($argv['params'])) {
                $vppDb->remove($argv['params']);
                Response::json(array(
                    'request' => $argv,
                    'success' => true
                ));
            }
            else {
                Response::json(array(
                    'success' => false,
                    'message' => 'VPP exists in CAPPHAT'
                ));
            }
        }
        else {
            Response::json(array(
                'success' => false,
                'message' => 'Method is not allowed'
            ), 405);
        }
    }

    public function isExistInCapPhat($argv) {
        $capphatDb = new CapPhatDatabase();
        $argv['params'] = checkInputParams($argv['params']);
        if ($capphatDb->isVppExist($argv['params'])) {
            Response::json(array(
                'success' => false,
                'message' => 'VPP exists in CAPPHAT',
                'request' => $argv
            ));
        }
        else {
            Response::json(array(
                'success' => true,
                'message' => 'Ok',
                'request' => $argv
            ));
        }
    }
}