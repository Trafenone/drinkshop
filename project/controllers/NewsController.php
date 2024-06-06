<?php

namespace project\controllers;

use core\Template;

class NewsController
{
    public function actionIndex()
    {
        $template = new Template('project/views/news/index.php');
        return ['title' => 'Index', 'content' => $template->getHTML()];
    }

    public function actionAdd()
    {
        $template = new Template('project/views/news/add.php');
        return ['title' => 'Add news', 'content' => $template->getHTML()];
    }
}
