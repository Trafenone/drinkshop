<?php

namespace core;

class Model
{
    protected $fieldArray;
    protected $primaryKey = 'id';

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
        return $this->fieldArray[$key];
    }
}