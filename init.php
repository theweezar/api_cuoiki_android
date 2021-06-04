<?php

// entites
require($_SERVER['DOCUMENT_ROOT'].'/../entities/PhongBanEntity.php');
require($_SERVER['DOCUMENT_ROOT'].'/../entities/NhanVienEntity.php');
require($_SERVER['DOCUMENT_ROOT'].'/../entities/VanPhongPhamEntity.php');
require($_SERVER['DOCUMENT_ROOT'].'/../entities/CapPhatEntity.php');
require($_SERVER['DOCUMENT_ROOT'].'/../entities/NhaCungCapEntity.php');
require($_SERVER['DOCUMENT_ROOT'].'/../entities/PhieuCungCapEntity.php');
require($_SERVER['DOCUMENT_ROOT'].'/../entities/ChiTietCungCapEntity.php');

// databases
require($_SERVER['DOCUMENT_ROOT'].'/../databases/Database.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/DatabaseInterface.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/PhongBanDatabase.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/NhanVienDatabase.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/VanPhongPhamDatabase.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/PhieuCungCapDatabase.php');

// helpers
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/Tools.php');
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/imageHelper.php');

// Server
require($_SERVER['DOCUMENT_ROOT'].'/../server/Request.php');
require($_SERVER['DOCUMENT_ROOT'].'/../server/Response.php');
require($_SERVER['DOCUMENT_ROOT'].'/../server/Server.php');

$server = new Server();
$server->execute();