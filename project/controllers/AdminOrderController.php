<?php

namespace project\controllers;

use core\Controller;
use project\models\Order;

class AdminOrderController extends Controller
{
    public function actionIndex()
    {
        $orders = Order::getAllOrders();
        return $this->render(null, ['orders' => $orders]);
    }

    public function actionView($params)
    {
        $orderId = intval($params[0]);
        $order = Order::getOrderById($orderId);
        $orderItems = Order::getOrderItems($orderId);
        return $this->render(null, ['order' => $order, 'orderItems' => $orderItems]);
    }

    public function actionUpdateStatus($params)
    {
        $orderId = intval($params[0]);
        $status = $this->post->status;
        Order::updateOrderStatus($orderId, $status);
        $this->redirect('/adminOrder/view/' . $orderId);
    }
}