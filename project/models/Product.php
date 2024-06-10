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

    public static function getProduct($id)
    {
        return Core::getInstance()->db->findOne(
            'SELECT p.id, p.name, p.description, p.price, p.image, c.name 
            AS category_name, c.id AS category_id FROM products AS p JOIN categories AS c ON p.category_id = c.id
            WHERE p.id = :id',
            ['id' => $id]
        );
    }

    public static function getProducts(): array
    {
        return Core::getInstance()->db->findMany(
            'SELECT p.id, p.name, p.description, p.price, p.image, c.name 
            AS category_name, c.id AS category_id FROM products AS p JOIN categories AS c ON p.category_id = c.id'
        );
    }

    public static function getFilteredProducts($page, $productsPerPage, $category = null, $search = '')
    {
        $offset = ($page - 1) * $productsPerPage;
        $params = [];
        $sql = "SELECT p.id, p.name, p.description, p.price, p.image, c.name AS category_name 
                FROM products AS p 
                JOIN categories AS c ON p.category_id = c.id 
                WHERE 1=1 ";

        if ($category) {
            $sql .= " AND p.category_id = :category";
            $params['category'] = $category;
        }

        if ($search) {
            $sql .= " AND (p.name LIKE :search1 OR p.description LIKE :search2)";
            $params['search1'] = "%$search%";
            $params['search2'] = "%$search%";
        }

        $sql .= " LIMIT " . (int)$productsPerPage . " OFFSET " . (int)$offset;

        $products = Core::getInstance()->db->findMany($sql, $params);

        $params = [];

        $countSql = "SELECT COUNT(*) FROM products WHERE 1=1 ";
        if ($category) {
            $countSql .= " AND category_id = :category";
            $params['category'] = $category;
        }

        if ($search) {
            $countSql .= " AND (name LIKE :search1 OR description LIKE :search2)";
            $params['search1'] = "%$search%";
            $params['search2'] = "%$search%";
        }

        $totalProducts = Core::getInstance()->db->findOne($countSql, $params);

        $totalPages = ceil( $totalProducts->{'COUNT(*)'}/ $productsPerPage);

        return [
            'products' => $products,
            'totalPages' => $totalPages,
        ];
    }

    public static function addProduct(Product $product, array $photo): void
    {
        $newPath = self::uploadPhoto($photo);
        if ($newPath) {
            $product->image = $newPath;
            $product->save();
        } else {
            throw new \Exception('Failed to upload photo');
        }
    }

    public static function editProduct(Product $product, array $photo): void
    {
        $oldProduct = Product::findById($product->id);

        if (empty($photo['tmp_name'])) {
            $product->image = $oldProduct->image;
        } else {
            $newPath = self::uploadPhoto($photo);

            if ($newPath) {
                if ($oldProduct->image != null && is_file($oldProduct->image)) {
                    unlink($oldProduct->image);
                }

                $product->image = $newPath;
            } else {
                throw new \Exception('Failed to upload photo');
            }
        }

        $product->save();
    }

    public static function deleteProduct($id)
    {
        $product = Product::findById($id);

        if (is_file($product->image)) {
            unlink($product->image);
        }

        self::deleteById($id);
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