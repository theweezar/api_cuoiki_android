<?php

// Helpers
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/Database.php');
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/Helper.php');
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/PhongBanDatabase.php');

// Controllers
require($_SERVER['DOCUMENT_ROOT'].'/../controllers/Controller.php');
require($_SERVER['DOCUMENT_ROOT'].'/../controllers/PhongBanController.php');


require($_SERVER['DOCUMENT_ROOT'].'/../server/Server.php');

$server = new Server();
$server->execute();