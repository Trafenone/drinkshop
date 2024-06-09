<?php

namespace project\controllers;

use core\Controller;
use project\models\Category;
use project\models\Product;

class AdminController extends Controller
{
    public function actionProducts()
    {
        $products = Product::getProducts();

        $this->template->setParam('products', $products);

        return $this->render();
    }

    public function actionCategories()
    {
        $categories = Category::getCategories();

        $this->template->setParam('categories', $categories);

        return $this->render();
    }
}