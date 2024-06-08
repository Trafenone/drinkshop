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
    public $session;
    public $db;

    private function __construct()
    {
        $this->template = new Template($this->defaultLayout);

        $host = Config::getInstance()->dbHost;
        $name = Config::getInstance()->dbName;
        $login = Config::getInstance()->dbLogin;
        $password = Config::getInstance()->dbPassword;

        $this->db = new DB($host, $name, $login, $password);

        $this->session = new Session();

        session_start();
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Core();
        }

        return self::$instance;
    }

    public function run($route)
    {
        $this->router = new Router($route);
        $params = $this->router->run();
        if (!empty($params)) {
            $this->template->setParams($params);
        }
    }

    public function done()
    {
        $this->template->display();

        $this->router->done();
    }
}