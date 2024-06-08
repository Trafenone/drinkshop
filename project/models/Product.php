<?php

namespace project\models;

use core\Core;
use core\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image
 * @property int $category_id
 */
class Product extends Model
{
    public static $tableName = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    public static function getProducts(): array
    {
        return self::getAll(self::$tableName);
    }

    public static function addProduct(Product $product, array $photo)
    {
        $tmpName = $photo['tmp_name'];
        $fileId = uniqid();
        $extension = explode('/', $photo['type'])[1];
        $newPath = "project/wwwroot/uploads/products/{$fileId}.{$extension}";
        move_uploaded_file($tmpName, $newPath);
        $product->image = $newPath;
        $product->save();
    }
}