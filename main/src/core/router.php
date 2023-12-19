<?php
require_once __DIR__ . "/route.php";

class Router {
    private static $routes = [];

    public function addRoute(array $methods, string $uri, string $controller) {
        self::$routes[] = new Route($methods, $uri, $controller);
    }

    public static function matchRoute(string $uri) {
        foreach (self::$routes as $route) {
            if ($route->getURI() === $uri) {
                $match = $route;
                break;
            }
        }
        if (isset($match)) {
            $match->executeController();
        }
        else {
            echo "not found";
        }
    }
}

?>