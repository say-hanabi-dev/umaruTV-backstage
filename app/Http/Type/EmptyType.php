<?php
namespace App\Http\Type;

class EmptyType{
    private $date = [];
    public function __get($name)
    {
//        return $this;
        return null;
    }
    public function __set($name, $value)
    {
        $this->date[$name] = $value;
    }

    public function __toString()
    {
        return '';
    }
}