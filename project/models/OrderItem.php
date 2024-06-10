<?php

namespace project\models;

use core\Model;

/**
 * @property int $id;
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * */
class OrderItem extends Model
{
    public static $tableName = 'order_items';

    public static function addOrderItem($orderId, $productId, $quantity, $price)
    {
        $orderItem = new OrderItem();
        $orderItem->order_id = $orderId;
        $orderItem->product_id = $productId;
        $orderItem->quantity = $quantity;
        $orderItem->price = $price;
        $orderItem->save();
    }
}