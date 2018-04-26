<?php
session_start();
require('vendor/autoload.php');
$routes = include 'configs/routes.php';
$routesParts = explode('/', $routes['default']);
$action = $routesParts[1];
$ressource = $routesParts[2];
$method = $_SERVER['REQUEST_METHOD'];
$a = $_REQUEST['a'] ?? $action;
$r = $_REQUEST['r'] ?? $ressource;
if (!in_array($method . '/' . $a . '/' . $r, $routes)) {
    die("Tu n'as rien a faire ici");
}
$controllerName = ucfirst($r) . 'Controller';
$controllerQualifiedName = "Blog\\Controllers\\".$controllerName;
$controller = new $controllerQualifiedName;
$data = call_user_func([$controller, $a]);
//var_dump($data);