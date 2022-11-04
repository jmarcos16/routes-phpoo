<?php

namespace app\core;

class Router
{
    public static function run()
    {

        try {

            $routerRegistered = new FilterRouter;
            $router = $routerRegistered->get();

            $controller = new ControllerInstance;
            $controller = $controller->execute($router);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
