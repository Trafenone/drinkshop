<?php

namespace project\controllers;

use core\Controller;
use project\models\Product;

class ProductsController extends Controller
{
    public function actionIndex()
    {
//        Core::getInstance()->db->insert('products', [
//           'name' => 'Test1',
//           'description' => 'Description 1',
//           'price' => 1.11,
//           'category_id' => 1
//        ]);
//
//        $products = Core::getInstance()->db->select('products', ['id', 'name', 'description', 'price']);
//
//        $last_product = end($products);
//
//        Core::getInstance()->db->update(
//            'products',
//            ['name' => 'New Name!!!'],
//            ['id' => $last_product->id]
//        );
//
//        Core::getInstance()->db->delete(
//          'products',
//          ['id' => $last_product->id]
//        );

        return $this->render();
    }

    public function actionAdd()
    {
//        $product = new Product();
//        $product->name = 'Test Name';
//        $product->description = 'Some description';
//        $product->price = 1.25;
//        $product->category_id = 1;
//        $product->save();

        return $this->render();
    }
}