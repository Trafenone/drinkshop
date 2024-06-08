<?php

use core\Core;

spl_autoload_register(static function ($class) {
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include_once $path;
    }
});

isset($_GET['route']) ? $route = $_GET['route'] : $route = '';

$core = Core::getInstance();
$core->run($route);
$core->done();