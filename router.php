<?php
session_start();
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
$controllerFile = $r . 'Controller.php';
require('controllers/' . $controllerFile);
$data = call_user_func($a, $r);
//var_dump($data);