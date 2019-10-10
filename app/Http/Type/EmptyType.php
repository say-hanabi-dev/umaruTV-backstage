<?php
namespace App\Http\Type;

class EmptyType{
    private $date = [];
    public function __get($name)
    {
        return null;
    }
    public function __set($name, $value)
    {
        $this->date[$name] = $value;
    }
}