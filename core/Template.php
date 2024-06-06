<?php

namespace core;

class Template
{
    protected $templateFilePath;
    protected $paramsArray;

    public function __construct($templateFilePath)
    {
        $this->templateFilePath = $templateFilePath;
        $this->paramsArray = [];
    }

    public function setParam($key, $value)
    {
        $this->paramsArray[$key] = $value;
    }

    public function setParams($params)
    {
        $this->paramsArray = array_merge($this->paramsArray, $params);
    }

    public function getHTML()
    {
        ob_start();
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