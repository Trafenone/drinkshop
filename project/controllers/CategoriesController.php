<?php

namespace project\controllers;

use core\Controller;
use project\models\Category;

class CategoriesController extends Controller
{
    public function actionAdd(): array
    {
        if ($this->isPost) {
            $name = $this->post->name;

            $this->validation($name);

            if (!$this->isErrorMessageExists()) {
                Category::addCategory($name);
                $this->redirect('/admin/categories');
            }
        }

        return $this->render();
    }

    public function actionEdit($params): array
    {
        $id = intval(array_shift($params));

        if ($this->isPost) {
            $category = new Category();
            $category->id = $id;
            $category->name = $this->post->name;

            $this->validation($category->name);

            if (!$this->isErrorMessageExists()) {
                $category->save();
                $this->redirect('/admin/categories');
            }
        }

        $category = Category::findById($id);

        $this->template->setParam('category', $category);

        return $this->render();
    }

    public function actionDelete($params): void
    {
        $id = intval(array_shift($params));

        //Category::deleteById($id);

        $this->redirect('/admin/categories');
    }

    private function validation($name): void
    {
        $category = Category::findByCondition(['name' => $name]);

        if (!empty($category)) {
            $this->addErrorMessage('Назви категорій мають бути унікальними!');
        }
    }
}