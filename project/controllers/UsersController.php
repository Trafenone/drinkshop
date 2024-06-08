<?php

namespace project\controllers;

use core\Controller;
use core\Core;
use project\models\User;


class UsersController extends Controller
{
    public function actionLogin()
    {
        if ($this->isGet) {
            return $this->render();
        }

        $user = User::findByEmailAndPassword($this->post->email, $this->post->password);

        if (!empty($user)) {
            User::login($user);
            $this->redirect('/');
        } else {
            $this->template->setParam('error_message', 'Неправильна пошта та/або пароль');
        }

        return $this->render();
    }

    public function actionLogout()
    {
        User::logout();

        $this->redirect('/users/login');
    }
}