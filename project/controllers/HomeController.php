<?php

namespace project\controllers;

class HomeController
{
    public function actionIndex()
    {
        return ['title' => 'Index', 'content' => 'Some content in Home View'];
    }

    public function actionView($params)
    {
        var_dump($params);
    }
}