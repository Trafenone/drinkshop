<?php

use Core\Router;

include('Core/Router.php');

spl_autoload_register(static function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path))
    {
        include_once $path;
    }
});

isset($_GET['route']) ? $route = $_GET['route'] : $route = '';

$router = new Router($route);
$router->run();

echo "<h1>index.php</h1>";