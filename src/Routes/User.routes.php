<?php

use Controllers\UserController;

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$controller = new UserController();

if ($method === 'GET' && $uri === '/users') {
    $controller->index();
    exit;
}

if ($method === 'GET' && preg_match('#^/users/(\d+)$#', $uri, $m)) {
    $controller->show((int)$m[1]);
    exit;
}

if ($method === 'POST' && $uri === '/users') {
    $controller->store();
    exit;
}
