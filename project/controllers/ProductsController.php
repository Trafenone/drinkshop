<?php

namespace project\controllers;

use core\Controller;
use core\Core;
use project\models\Cart;
use project\models\Category;
use project\models\Product;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        $products = Product::getProducts();
        $cart = Cart::getCart();

        if(!empty($cart)) {
            $cart = json_decode($cart, true);
        }

        $this->template->setParam('products', $products);
        $this->template->setParam('cart', $cart);

        return $this->render();
    }

    public function actionView($params)
    {
        $id = intval(array_shift($params));

        $product = Product::getProduct($id);
        $cart = Cart::getCart();

        if(!empty($cart)) {
            $cart = json_decode($cart, true);
        }

        $this->template->setParam('product', $product);
        $this->template->setParam('cart', $cart);

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

            $this->redirect('/admin/products');
        }

        return $this->render();
    }

    public function actionEdit($params)
    {
        $id = intval(array_shift($params));

        if($id <= 0) {
            return $this->error(400);
        }

        if($this->isPost) {
            $updatedProduct = new Product();
            $updatedProduct->id = $id;
            $updatedProduct->name = $this->post->name;
            $updatedProduct->description = $this->post->description;
            $updatedProduct->price = $this->post->price;
            $updatedProduct->category_id = $this->post->category_id;

            Product::editProduct($updatedProduct, $_FILES['image']);

            $this->redirect('/admin/products');
        }

        $product = Product::findById($id);
        $categories = Category::getCategories();

        $this->template->setParam('product', $product);
        $this->template->setParam('categories', $categories);

        return $this->render();
    }

    public function actionDelete($params)
    {
        $id = intval(array_shift($params));

        Product::deleteProduct($id);

        $this->redirect('/admin/products');
    }
}