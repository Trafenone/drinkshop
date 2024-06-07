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
    public $table = 'products';

    public function __construct()
    {

    }

    public function save()
    {
        $value = $this->{$this->primaryKey};
        if(empty($value)) {
            Core::getInstance()->db->insert($this->table, $this->fieldArray);
        } else {
            Core::getInstance()->db->update($this->table, $this->fieldArray, [
                $this->primaryKey => $this->{$this->primaryKey}
            ]);
        }
    }
}