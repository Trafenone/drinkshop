<?php

namespace core;

use project\controllers\ErrorController;

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

        Core::getInstance()->moduleName = $parts[0];
        Core::getInstance()->actionName = $parts[1];

        $controller = 'project\\controllers\\' . ucfirst($parts[0]) . 'Controller';
        $method = 'action' . ucfirst($parts[1]);

        if (class_exists($controller)) {
            $controllerObject = new $controller();
            Core::getInstance()->controllerObject = $controllerObject;
            if (method_exists($controllerObject, $method)) {
                array_splice($parts, 0, 2);
                $actionResult = $controllerObject->$method($parts);
                if ($actionResult instanceof Error) {
                    return $this->error($actionResult->code, $actionResult->message);
                } else {
                    return $actionResult;
                }
            } else {
                return $this->error(404);
            }
        } else {
            return $this->error(404);
        }
    }

    public function error($code, $message = null)
    {
        Core::getInstance()->moduleName = 'error';
        Core::getInstance()->actionName = 'error';
        Core::getInstance()->controllerObject = new ErrorController();

        return Core::getInstance()->controllerObject->actionError($code);
    }
}