<?php

namespace project\controllers;

use core\Controller;
use core\Core;
use project\models\Category;
use project\models\Product;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        $products = Product::getProducts();

        $this->template->setParam('products', $products);

        return $this->render();
    }

    public function actionAdd()
    {
        if ($this->isGet) {
            $categories = Category::getCategories();

            $this->template->setParam('categories', $categories);
        }

        if ($this->isPost) {
            $product = new Product();
            $product->name = $this->post->name;
            $product->description = $this->post->description;
            $product->price = $this->post->price;
            $product->category_id = $this->post->category_id;

            Product::addProduct($product, $_FILES['image']);

            $this->redirect('/products/index');
        }

        return $this->render();
    }
}