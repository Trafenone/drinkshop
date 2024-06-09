<?php

namespace project\controllers;

use core\Controller;

class ErrorController extends Controller
{
    public function actionError($code)
    {
        switch ($code) {
            case 400:
            case 404:
                http_response_code($code);
                return $this->render('project/views/error/error-404.php');
            case 500:
                http_response_code($code);
                return $this->render('project/views/error/error-500.php');
        }
    }
}