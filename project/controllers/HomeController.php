<?php

namespace project\controllers;

use core\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        return $this->render();
    }
}