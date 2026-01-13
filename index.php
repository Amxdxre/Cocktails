<?php

use Cocktails\Controller\API;
use Cocktails\Controller\CocktailController;
use Cocktails\Controller\Ingredient;

include "vendor/autoload.php";
include "generated-conf/config.php";

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/cocktails', [CocktailController::class, 'renderPage']);
    $route->addRoute('GET', '/ingredients', [Ingredient::class, 'renderPage']);
    $route->addRoute('POST', '/api/{controller}', [API::class, 'processPost']);
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
            call_user_func_array([$controller, $method], [$APIcontroller, $rawBody]);
            break;
        }
        call_user_func_array([$controller, $method], []);
        break;
}