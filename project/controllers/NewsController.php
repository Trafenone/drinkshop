<?php

namespace project\controllers;

use core\Controller;
use core\Core;

class NewsController extends Controller
{
    public function actionIndex()
    {
        return $this->render();
    }

    public function actionView($params)
    {
        var_dump($params);
    }

    public function actionAdd()
    {
        Core::getInstance()->template->setParam('title', 'Add');
        return $this->render();
    }
}
