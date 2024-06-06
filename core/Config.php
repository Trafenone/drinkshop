<?php

namespace core;

class Config
{
    protected static $instance;
    protected $params;

    private function __construct()
    {
        $this->params = [];
        $directory = 'config';
        $configFiles = scandir('config');
        foreach ($configFiles as $configFile) {
            if(substr($configFile, -4) === '.php') {
                $path = $directory . '/' . $configFile;
                include($path);
            }
        }

        /** @var array $config */
        foreach ($config as $cnf) {
            foreach ($cnf as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function __set($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function __get($key)
    {
        return $this->params[$key];
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}