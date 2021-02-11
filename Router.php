<?php

    /* Author: @UnrealSec */

    class Router {
        private static $routes = [];

        public static function route($method, $path, $action) {
            self::$routes[] = new Route($method, $path, $action);
        }

        public static function accept() {
            for ($i = count(self::$routes)-1; $i > -1; $i--) {
                $route = self::$routes[$i];
                
                if ($_SERVER['REQUEST_METHOD'] === '*' || $_SERVER['REQUEST_METHOD'] === $route->method) {
                    $matches = null;
                    if (1 === preg_match($route->path, $_SERVER['REQUEST_URI'], $matches)) {
                        array_shift($matches);
                        ($route->action)($matches);
                        return;
                    }
                }
            }

            throw new NoRouteException('Route not found!');
        }
    }

    class Route {
        public $method = null;
        public $path = null;
        public $action = null;

        function __construct($method, $path, $action) {
            if (!is_string($method)) $method = '';
            if (!is_string($path)) $path = '';
            if (!is_callable($action)) $action = function() {};

            $this->method = $method;
            $this->path = $path;
            $this->action = $action;
        }
    }

    class NoRouteException extends Exception {}

?>
