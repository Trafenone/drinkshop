<?php

namespace project\models;

use core\Core;
use core\Model;

class Cart extends Model
{
    public static function getCart() : mixed
    {
        return Core::getInstance()->session->get('cart');
    }
}