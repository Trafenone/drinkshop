<?php

namespace project\models;

use core\Core;
use core\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property float $total_amount
 * @property string $status
 * @property string $address
 * @property string $phone
 * */
class Order extends Model
{
    public static $tableName = 'orders';

    public static function getAllOrders()
    {
        $sql = "SELECT o.*, u.username, u.email
                FROM orders AS o
                JOIN users AS u ON o.user_id = u.id";
        return Core::getInstance()->db->findMany($sql);
    }

    public static function getOrderById($id)
    {
        $sql = "SELECT o.*, u.username, u.email
                FROM orders AS o
                JOIN users AS u ON o.user_id = u.id
                WHERE o.id = :id";
        return Core::getInstance()->db->findOne($sql, ['id' => $id]);
    }

    public static function getOrderItems($orderId)
    {
        $sql = "SELECT oi.*, p.name AS product_name
                FROM order_items AS oi
                JOIN products AS p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";
        return Core::getInstance()->db->findMany($sql, ['order_id' => $orderId]);
    }

    public static function updateOrderStatus($orderId, $status)
    {
        $sql = "UPDATE orders SET status = :status, updated_at = NOW() WHERE id = :id";
        return Core::getInstance()->db->findOne($sql, ['status' => $status, 'id' => $orderId]);
    }

    public static function create($userId, $totalAmount, $status, $address, $phone): int
    {
        $order = new Order();
        $order->user_id = $userId;
        $order->total_amount = $totalAmount;
        $order->status = $status;
        $order->address = $address;
        $order->phone = $phone;
        return $order->save();
    }
}