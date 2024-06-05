<?php

namespace Core;

class Router
{
    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function run()
    {
        $parts = explode('/', $this->route);

        if ($parts[0] == '') {
            $parts[0] = 'home';
            $parts[1] = 'index';
        }

        if (count($parts) == 1) {
            $parts[1] = 'index';
        }

        $controller = 'Project\\Controllers\\' . ucfirst($parts[0]) . 'Controller';
        $method = 'action' . ucfirst($parts[1]);


        if (class_exists($controller)) {
            $controllerObject = new $controller();
            if (method_exists($controllerObject, $method)) {
                return $controllerObject->$method();
            } else {
                $this->error(404);
            }
        } else {
            $this->error(404);
        }


    }

    public function error($code)
    {
        http_response_code($code);
        echo $code;
    }
}