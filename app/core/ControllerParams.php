<?php

namespace app\core;

use app\support\Uri;
use app\routes\Route;
use app\support\Method;

class ControllerParams
{
    public function get(array $router)
    {
        $method = Method::get();
        $allRoutes = Route::getRoutes();

        $router = array_filter($allRoutes[$method], function ($item) use ($router) {
            if ($item === $router) {
                return array_keys($item);
            }
        });

        $filterParams = array_values($this->filterParamsOfIndex($router));
        list($params) = $filterParams;

        return $params;
    }


    private function filterParamsOfIndex(array $router)
    {

        $explodeUri = explode('/', Uri::get());
        $explodeRouter = explode('/', array_keys($router)[0]);

        $params = [];

        foreach ($explodeRouter as $index => $RouterSegment) {
            if ($RouterSegment !== $explodeUri[$index]) {
                $params[$index] = $explodeUri[$index];
            }
        }

        return $params;
    }
}
