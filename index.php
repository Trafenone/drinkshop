<?php

use core\Core;

include('core/Router.php');

spl_autoload_register(static function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path))
    {
        include_once $path;
    }
});

isset($_GET['route']) ? $route = $_GET['route'] : $route = '';

$core = Core::getInstance();
$core->run($route);
$core->done();