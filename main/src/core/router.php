<?php
require_once __DIR__ . "/route.php";
require_once __DIR__ . "/../lib/HttpErrorManager.php";

class Router {
    private static $routes = [];

    public function addRoute(array $methods, string $uri, string $controller) {
        self::$routes[] = new Route($methods, $uri, $controller);
    }

    public static function matchRoute(string $uri) {
        foreach (self::$routes as $route) {
            $parsedRoute = parse_url($uri)["path"];
            if ($route->getURI() === $parsedRoute) {
                $match = $route;
                break;
            }
        }
        if (isset($match)) {
            $match->executeController();
        }
        else {
            HttpErrorManager::redirectError("404");
        }
    }
}

?>