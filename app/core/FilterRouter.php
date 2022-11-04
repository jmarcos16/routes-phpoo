<?php

namespace app\core;

use Exception;
use app\support\Uri;
use app\routes\Route;
use app\support\Method;

class FilterRouter
{

    private string $uri;
    private string $method;
    private array $routesRegistered;

    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = Method::get();
        $this->routesRegistered = Route::getRoutes();
    }

    private function filterDynamicsRoutes(array $routes)
    {
        foreach (array_keys($routes) as $value) {
            if (!preg_match("/\/{[a-z]+}/", $value)) {
                unset($routes[$value]);
            }
        }

        return $routes;
    }

    private function clearDynamicsRoutes(array $routes)
    {

        foreach (array_keys($routes) as $route) {
            if (preg_match("/\/{[a-z]+}/", $route)) {
                $replace = (preg_replace("/\/{[a-z]+}/", '', $route));
                $routes[$replace] = $routes[$route];
                unset($routes[$route]);
            }
        }

        return $routes;
    }

    public function simpleRouter()
    {

        if (in_array($this->uri, array_keys($this->routesRegistered[$this->method]))) {
            return $this->routesRegistered[$this->method][$this->uri];
        }

        return null;
    }

    public function dynamicRouter()
    {

        $filterDynemics = $this->filterDynamicsRoutes($this->routesRegistered[$this->method]);
        $clearDynemicsRoutes = $this->clearDynamicsRoutes($filterDynemics);

        foreach ($clearDynemicsRoutes as $index => $route) {

            $regex = str_replace('/', '\/', trim($index, '/'));
            if ($index !== '/' && preg_match("/^$regex\/[0-9]+$/", trim($this->uri, '/'))) {
                $routerRegisteredFound = $route;
                break;
            } else {
                $routerRegisteredFound = null;
            }
        }

        return $routerRegisteredFound;
    }

    public function get()
    {

        $router = $this->simpleRouter();

        if ($router) {
            return $router;
        }

        $router = $this->dynamicRouter();

        if ($router) {
            return $router;
        }

        throw new Exception('Router not found');
    }
}
