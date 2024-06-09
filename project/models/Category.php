<?php

namespace project\models;

use core\Model;

/**
 * @property int $id
 * @property string $name
 */
class Category extends Model
{
    public static $tableName = 'categories';

    public static function getCategories()
    {
        return self::getAll(self::$tableName);
    }

    public static function addCategory($name)
    {
        $category = new Category();
        $category->name = $name;
        $category->save();
    }
}