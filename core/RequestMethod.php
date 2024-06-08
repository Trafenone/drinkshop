<?php

namespace core;

class RequestMethod
{
    public Array $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function __get($key)
    {
        if(!isset($this->array[$key])) {
            return null;
        }

        return $this->array[$key];
    }

    public function getAll()
    {
        return $this->array;
    }
}