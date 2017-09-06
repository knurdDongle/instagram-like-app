<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT_PATH', dirname(__FILE__));
require_once('components/Autoload.php');
require_once('config/constants.php');

session_start();

$router = new Router();
$router->run();