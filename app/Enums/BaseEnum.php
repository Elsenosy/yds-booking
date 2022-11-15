<?php 
namespace App\Enums;

abstract class BaseEnum{
    public static function items() : array
    {
        $ref = new \ReflectionClass(static::class);
        return $ref->getConstants();
    }
}