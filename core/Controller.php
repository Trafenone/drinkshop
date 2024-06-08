<?php

namespace core;

class Controller
{
    protected $template;
    protected $errorMessages;
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
        $this->errorMessages = [];
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

    public function addErrorMessage($message = null)
    {
        $this->errorMessages [] = $message;
        $this->template->setParam('error_message', implode('<br/>', $this->errorMessages));
    }

    public function clearErrorMessages()
    {
        $this->errorMessages = [];
        $this->template->setParam('error_message', null);
    }

    public function isErrorMessageExists()
    {
        return count($this->errorMessages) > 0;
    }
}