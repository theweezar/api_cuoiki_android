<?php

// Helpers
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/Database.php');
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/DatabaseHelper.php');
require($_SERVER['DOCUMENT_ROOT'].'/../helpers/PhongBanDatabase.php');

// Server
require($_SERVER['DOCUMENT_ROOT'].'/../server/Request.php');
require($_SERVER['DOCUMENT_ROOT'].'/../server/Response.php');
require($_SERVER['DOCUMENT_ROOT'].'/../server/Server.php');

$server = new Server();
$server->execute();