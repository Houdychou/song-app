<?php

ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../technical/Env.php';

use App\config\Router;

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);