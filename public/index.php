<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

session_start();

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers.php';

use Framework\Router;

$router = new Router();

require basePath('routes.php');

// Handle method spoofing for PUT and DELETE BEFORE routing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method'])) {
    $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
}

// Get the URI and strip the subfolder prefix
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Auto-strip whatever subdirectory this script lives in
// e.g. if SCRIPT_NAME is /ws03dilan/public/index.php, base is /ws03dilan/public
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($scriptDir !== '' && $scriptDir !== '/' && str_starts_with($uri, $scriptDir)) {
    $uri = substr($uri, strlen($scriptDir));
}

$uri = '/' . ltrim($uri, '/');
if ($uri === '') $uri = '/';

$router->route($uri);
