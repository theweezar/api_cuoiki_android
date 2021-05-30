<?php

// databases
require($_SERVER['DOCUMENT_ROOT'].'/../databases/Database.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/DatabaseInterface.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/PhongBanDatabase.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/NhanVienDatabase.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/VanPhongPhamDatabase.php');
require($_SERVER['DOCUMENT_ROOT'].'/../databases/PhieuCungCapDatabase.php');

// helpers
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/Tools.php');

// Server
require($_SERVER['DOCUMENT_ROOT'].'/../server/Request.php');
require($_SERVER['DOCUMENT_ROOT'].'/../server/Response.php');
require($_SERVER['DOCUMENT_ROOT'].'/../server/Server.php');

$server = new Server();
$server->execute();