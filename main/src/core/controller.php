<?php
require_once __DIR__ . "/view.php";

abstract class Controller {
    # Static attribute because we don't need multiple instances of the same controllers
    protected static array $request;
    protected static string $requestMethod;

    # We will use the GET and POST data
    public static function setRequest() {
        self::$requestMethod = $_SERVER["REQUEST_METHOD"];
        self::$request['GET'] = $_GET;
        self::$request['POST'] = $_POST;
    }
    
    # Main method that will execute the business logic
    public abstract static function execute();

    # Generic fetch function
    private static function _fetchAttribute($method, $key) {
        if (key_exists($method, self::$request)) {
            if (key_exists($key, self::$request[$method])) {
                return self::$request[$method][$key];
            }
        }
        return null;
    }

    # Fetch GET attribute
    protected static function getAttribute($key) {
        return self::_fetchAttribute("GET", $key);
    }

    # Fetch POST attribute
    protected static function postAttribute($key) {
        return self::_fetchAttribute("POST", $key);
    }
}

?>