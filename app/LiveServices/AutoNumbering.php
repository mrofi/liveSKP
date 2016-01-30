<?php

namespace App\LiveServices;

/**
*       
*/
class AutoNumbering
{
    protected static $number = 0;

    public static function getNumber()
    {
        static::$number++;

        return static::$number;
    }

    public static function restart()
    {
        static::$number = 0;
    }
    
}