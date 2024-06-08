<?php

namespace project\models;

use core\Core;
use core\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $category_id
 */
class Product extends Model
{
    public static $tableName = 'products';

    public function __construct()
    {
        parent::__construct();
    }
}