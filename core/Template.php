<?php

namespace core;

class Template
{
    protected $templateFilePath;
    protected $paramsArray;
    public Controller $controller;

    public function __construct($templateFilePath)
    {
        $this->templateFilePath = $templateFilePath;
        $this->paramsArray = [];
    }

    public function __set($key, $value)
    {
        Core::getInstance()->template->setParam($key, $value);
    }

    public function setTemplateFilePath($templateFilePath)
    {
        $this->templateFilePath = $templateFilePath;
    }

    public function setParam($key, $value)
    {
        $this->paramsArray[$key] = $value;
    }

    public function setParams($params)
    {
        foreach ($params as $key => $value) {
            $this->setParam($key, $value);
        }
        //$this->paramsArray = array_merge($this->paramsArray, $params);
    }

    public function getHTML()
    {
        ob_start();
        $this->controller = Core::getInstance()->controllerObject;
        extract($this->paramsArray);
        include $this->templateFilePath;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display()
    {
        echo $this->getHTML();
    }
}