<?php

namespace core;

class Controller
{
    protected $template;

    public function __construct()
    {
        $module = Core::getInstance()->moduleName;
        $action = Core::getInstance()->actionName;
        $path = "project/views/{$module}/{$action}.php";
        $this->template = new Template($path);
    }

    public function render()
    {
        return ['content' => $this->template->getHTML()];
    }
}