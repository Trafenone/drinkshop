<?php

namespace project\controllers;

use core\Controller;
use core\Core;
use project\models\Cart;
use project\models\Order;
use project\models\OrderItem;
use project\models\Product;

class CartController extends Controller
{
    public function actionIndex()
    {
        $cart = Cart::getCart();
        $products = [];

        if (!empty($cart)) {
            $cart = json_decode($cart, true);

            foreach ($cart as $productId => $quantity) {
                $product = Product::findById($productId);
                if ($product) {
                    $products[$productId] = $product;
                }
            }
        }

        $this->template->setParam('products', $products);
        $this->template->setParam('cart', $cart);

        return $this->render();
    }

    public function actionCheckout()
    {
        $session = Core::getInstance()->session;
        $cart = json_decode($session->get('cart') ?: '{}', true);

        if ($this->isPost) {
            $address = $this->post->address;
            $phone = $this->post->phone;

            $userId = $session->get('user')->id;
            $totalAmount = 0;

            foreach ($cart as $productId => $quantity) {
                $product = Product::findById($productId);
                if ($product) {
                    $totalAmount += $product->price * $quantity;
                }
            }

            $orderId = Order::create($userId, $totalAmount, 'pending', $address, $phone);

            foreach ($cart as $productId => $quantity) {
                $product = Product::findById($productId);
                if ($product) {
                    OrderItem::addOrderItem($orderId, $productId, $quantity, $product->price);
                }
            }

            $session->remove('cart');

            $this->redirect('/cart/success');
        }

        $products = $this->getCartProducts($cart);

        $this->template->setParam('cart', $cart);
        $this->template->setParam('products', $products);

        return $this->render();
    }

    public function actionSuccess()
    {
        return $this->render();
    }

    public function actionAdd($params)
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $productId = filter_var($input['productId'], FILTER_VALIDATE_INT);
        $quantity = filter_var($input['quantity'], FILTER_VALIDATE_INT);

        if ($productId === false || $quantity === false) {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
            return;
        }

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

    public function actionUpdate()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $productId = filter_var($input['productId'], FILTER_VALIDATE_INT);
        $quantity = filter_var($input['quantity'], FILTER_VALIDATE_INT);

        if ($productId === false || $quantity === false || $quantity < 1) {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
            return;
        }

        $session = Core::getInstance()->session;
        $cart = json_decode($session->get('cart') ?: '{}', true);

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
            $session->set('cart', json_encode($cart));
            echo json_encode(['success' => true, 'cart' => $cart]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
        }

        die;
    }

    public function actionRemove()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $productId = filter_var($input['productId'], FILTER_VALIDATE_INT);

        if ($productId === false) {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
            return;
        }

        $session = Core::getInstance()->session;
        $cart = json_decode($session->get('cart') ?: '{}', true);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $session->set('cart', json_encode($cart));
            echo json_encode(['success' => true, 'cart' => $cart]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
        }

        die;
    }

    private function getCartProducts($cart): array
    {
        $products = [];
        foreach ($cart as $productId => $quantity) {
            $product = Product::findById($productId);
            if ($product) {
                $products[$productId] = $product;
            }
        }

        return $products;
    }
}