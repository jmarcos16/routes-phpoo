<?php

namespace app\support;


class Uri
{
    public static function get()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
