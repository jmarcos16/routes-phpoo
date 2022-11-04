<?php

namespace app\core;

use Exception;

class Request
{
    public static function input(string $name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        throw new Exception('Index ' . $name . ' not found');
    }


    public static function all()
    {

        $post = [
            'name' => 'José Marcos',
            'email' => 'jose@xpmlogistica.com',
            'password' => 'secret123'
        ];

        return $post;
    }

    public static function only(string|array $only)
    {
        $fildsPost = self::all();
        $fildsPostKeys = array_keys($fildsPost);

        foreach ($fildsPostKeys as $index => $value) {
            if ($value != (is_string($only) ? $only : (isset($only[$index]) ? $only[$index] : null))) {
                unset($fildsPost[$value]);
            }
        }

        return $fildsPost;
    }

    public static function excepts(string|array $excepts)
    {

        $fildsPost = self::all();

        if (is_array($excepts)) {
            foreach ($excepts as $index => $value) {
                unset($fildsPost[$index]);
            }
        }

        if (is_string($excepts)) {
            unset($fildsPost[$excepts]);
        }

        return $fildsPost;
    }
}
