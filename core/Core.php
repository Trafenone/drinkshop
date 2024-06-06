<?php

namespace core;

class Core
{
    private static $instance;
    public $defaultLayout = 'project/views/layouts/index.php';
    public $moduleName;
    public $actionName;
    public $router;
    public $template;

    private function __construct()
    {
        $this->template = new Template($this->defaultLayout);
    }

    public static function getInstance()
    {
        if(empty(self::$instance)) {
            self::$instance = new Core();
        }

        return self::$instance;
    }

    public function run($route)
    {
        $this->router = new Router($route);
        $params = $this->router->run();
        $this->template->setParams($params);
    }

    public function done()
    {
        $this->template->display();

        $this->router->done();
    }
}