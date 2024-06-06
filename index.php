<?php

use core\router;
use core\Template;

include('core/Router.php');

spl_autoload_register(static function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path))
    {
        include_once $path;
    }
});

isset($_GET['route']) ? $route = $_GET['route'] : $route = '';

$router = new router($route);
$router->run();
$router->done();