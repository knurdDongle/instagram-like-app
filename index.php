<?php

ini_set('display_errors', 1);

error_reporting(E_ALL);

define('ROOT_PATH', dirname(__FILE__));

require_once('components/Autoload.php');

session_start();

require_once('config/constants.php');

$router = new Router();
$router->run();