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

    public static function getProductCategory($id)
    {
        return Category::findById($id);
    }

    public static function addProduct(Product $product, array $photo) : void
    {
        $newPath = self::uploadPhoto($photo);
        if ($newPath) {
            $product->image = $newPath;
            $product->save();
        } else {
            throw new \Exception('Failed to upload photo');
        }
    }

    public static function editProduct(Product $product, array $photo) : void
    {
        $oldProduct = Product::findById($product->id);

        if(empty($photo['tmp_name'])) {
            $product->image = $oldProduct->image;
        } else {
            $newPath = self::uploadPhoto($photo);

            if($newPath) {
                if (is_file($oldProduct->image)) {
                    unlink($oldProduct->image);
                }

                $product->image = $newPath;
            } else {
                throw new \Exception('Failed to upload photo');
            }
        }

        $product->save();
    }

    private static function uploadPhoto(array $photo): ?string
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 2 * 1024 * 1024;

        if (!in_array($photo['type'], $allowedTypes)) {
            return null;
        }

        if ($photo['size'] > $maxSize) {
            return null;
        }

        $tmpName = $photo['tmp_name'];
        $fileId = uniqid();
        $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $newPath = "project/wwwroot/uploads/products/{$fileId}.{$extension}";

        if (move_uploaded_file($tmpName, $newPath)) {
            return $newPath;
        } else {
            return null;
        }
    }
}