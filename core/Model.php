<?php

namespace core;

class Model
{
    protected $fieldArray;
    protected static $primaryKey = 'id';
    protected static $tableName = '';

    function __construct()
    {
        $this->fieldArray = [];
    }

    public function __set($key, $name)
    {
        $this->fieldArray[$key] = $name;
    }

    public function __get($key)
    {
        if(!isset($this->fieldArray[$key])) {
            return null;
        }

        return $this->fieldArray[$key];
    }

    public static function deleteById($id)
    {
        Core::getInstance()->db->delete(static::$tableName, [static::$primaryKey => $id]);
    }

    public static function deleteByCondition($conditionAssocArray)
    {
        Core::getInstance()->db->delete(static::$tableName, $conditionAssocArray);
    }

    public static function findById($id) : object | null
    {
        $arr = Core::getInstance()->db->select(static::$tableName, '*', [
            static::$primaryKey => $id
        ]);

        if (count($arr) > 0) {
            return $arr[0];
        } else {
            return null;
        }
    }

    public static function findByCondition($conditionAssocArray) : array | null
    {
        $arr = Core::getInstance()->db->select(static::$tableName, '*', $conditionAssocArray);

        if (count($arr) > 0) {
            return $arr;
        } else {
            return null;
        }
    }

    public function save() : void
    {
        $value = $this->{static::$primaryKey};
        if (empty($value)) {
            Core::getInstance()->db->insert(static::$tableName, $this->fieldArray);
        } else {
            Core::getInstance()->db->update(static::$tableName, $this->fieldArray, [
                static::$primaryKey => $this->{static::$primaryKey}
            ]);
        }
    }
}