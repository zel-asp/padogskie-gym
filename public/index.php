<?php
session_start();


const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'core/function/function.php';

//this will load class file automatically when they called
spl_autoload_register(function ($class) {

    $class = str_replace("Core" . DIRECTORY_SEPARATOR, "", $class);

    require base_path("core/Class/{$class}.php");
});

//instance ot router class
$router = new Core\Router;

//file paths
$routes = require base_path('core/routing/routes.php');

//uri
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method = $_POST['__method'] ?? $_SERVER['REQUEST_METHOD'];

$router->routes($uri, $method);



