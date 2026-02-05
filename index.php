<?php

use Cocktails\Controller\Admin;
use Cocktails\Controller\API;
use Cocktails\Controller\Cocktails;
use Cocktails\Controller\Ingredients;

include "vendor/autoload.php";
include "generated-conf/config.php";

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/cocktails', [Cocktails::class, 'renderPage']);
    $route->addRoute('GET', '/ingredients', [Ingredients::class, 'renderPage']);
    $route->addRoute('GET', '/admin', [Admin::class, 'renderAdminPanel']);
    $route->addRoute('GET', '/api/{controller}/{id}', [API::class, 'processGet']);
    $route->addRoute('POST', '/api/{controller}', [API::class, 'processPost']);
    $route->addRoute('PATCH', '/api/{controller}', [API::class, 'processUpdate']);
    $route->addRoute('DELETE', '/api/{controller}', [API::class, 'processDelete']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        die();
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        http_response_code(405);
        die();
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $controllerClass = $handler[0];
        $controller = new $controllerClass;
        $method = $handler[1];
        if ($handler[0] === API::class) {
            $APIcontroller = $vars['controller'];
            $rawBody = file_get_contents('php://input');
            if (!empty($vars['id'])) {
                $rawBody = $vars['id'];
            }
            call_user_func_array([$controller, $method], [$APIcontroller, $rawBody]);
            break;
        }
        $content = file_get_contents('php://input');
        call_user_func_array([$controller, $method], (array)$content);
        break;
}