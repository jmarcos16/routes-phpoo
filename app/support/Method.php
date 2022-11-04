<?php

namespace app\support;

class Method
{
    public static function get()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
