<?php

namespace app\core;

use Exception;

class ControllerInstance
{
    public function execute($router)
    {
        list($controller, $function) = $router;

        if (!class_exists($controller)) {
            throw new Exception($controller . ' not found ');
        }

        $controller = new $controller;

        if (!method_exists($controller, $function)) {
            throw new Exception($function . ' not found in ' . get_class($controller));
        }

        $params = new ControllerParams;
        $params = $params->get($router);

        $controller->$function($params);
    }
}
