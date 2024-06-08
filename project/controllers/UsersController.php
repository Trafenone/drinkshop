<?php

namespace project\controllers;

use core\Controller;
use project\models\User;


class UsersController extends Controller
{
    public function actionLogin()
    {
        if(User::isUserLogged()) {
            $this->redirect('/');
        }

        if ($this->isPost) {
            $user = User::findByEmailAndPassword($this->post->email, $this->post->password);

            if (!empty($user)) {
                User::login($user);
                $this->redirect('/');
            } else {
                $this->addErrorMessage('Неправильна пошта та/або пароль');
            }
        }

        return $this->render();
    }

    public function actionRegister()
    {
        if($this->isPost) {
            $email = $this->post->email;
            $user = User::findByEmail($email);

            if(!empty($user)) {
                $this->addErrorMessage('Користувач з такою поштою вже існує');
            }

            if($this->post->password != $this->post->confirm_password) {
                $this->addErrorMessage('Паролі не співпадають');
            }

            if(!$this->isErrorMessageExists()) {
                User::register($this->post->username, $this->post->email, $this->post->password);

                $this->redirect('/users/success');
            }
        }

        return $this->render();
    }

    public function actionLogout()
    {
        User::logout();

        $this->redirect('/users/login');
    }

    public function actionSuccess()
    {
        return $this->render();
    }
}