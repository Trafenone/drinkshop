<?php

namespace project\controllers;

use core\Controller;
use core\Core;

class CartController extends Controller
{
    public function actionAdd($params)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $productId = $data['productId'];
        $quantity = $data['quantity'];

        $session = Core::getInstance()->session;
        $cart = json_decode($session->get('cart') ?: '{}', true);

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        $session->set('cart', json_encode($cart));

        echo json_encode(['success' => true]);
        die;
    }
}