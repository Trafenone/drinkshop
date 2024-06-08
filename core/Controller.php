<?php

namespace core;

class Controller
{
    protected $template;
    public $isGet = false;
    public $isPost = false;
    public $get;
    public $post;

    public function __construct()
    {
        $module = Core::getInstance()->moduleName;
        $action = Core::getInstance()->actionName;
        $path = "project/views/{$module}/{$action}.php";
        $this->template = new Template($path);

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->isPost = true;
                break;
            case 'GET':
                $this->isGet = true;
                break;
        }

        $this->get = new Get();
        $this->post = new Post();
    }

    public function render($pathToView = null)
    {
        if ($pathToView) {
            $this->template->setTemplateFilePath($pathToView);
        }

        return ['content' => $this->template->getHTML()];
    }

    public function redirect($path)
    {
        header('Location: ' . $path);
        die;
    }
}