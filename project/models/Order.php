<?php

namespace project\models;

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