<?php
require_once __DIR__ . "/view.php";
require_once __DIR__ . "/../lib/HttpErrorManager.php";
require_once __DIR__ . "/../lib/SessionManager.php";
require_once __DIR__ . "/../lib/RedirectManager.php";
require_once __DIR__ . "/../lib/PrivilegeMiddleware.php";

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

    # Main method that will execute the business logic (need to implement it in children classes)
    public abstract static function execute();

    # Generic fetch function (do not use)
    private static function _fetchAttribute($method, $key) {
        if (key_exists($method, self::$request)) {
            if (key_exists($key, self::$request[$method])) {
                return self::$request[$method][$key];
            }
        }
        return null;
    }

    # Fetch GET attribute
    protected static function fetchGET($key) {
        return self::_fetchAttribute("GET", $key);
    }

    # Fetch POST attribute
    protected static function fetchPOST($key) {
        return self::_fetchAttribute("POST", $key);
    }

    # Method that verifies that the target params are set in the target array
    # Mainly for request params verification, do not use
    private static function _verifyParamsGeneric(array $array, array $params) {
        foreach ($params as $param) {
            if (!isset($array[$param])) {
                return false;
            }
        }
        return true;
    }

    # Verifies POST parameters
    protected static function verifyParamsPOST(array $params) {
        if (!self::isPostRequest()) {
            return false;
        }
        self::_verifyParamsGeneric(self::$request["POST"], $params);
    }
    
    # Verifies GET parameters
    protected static function verifyParamsGET(array $params) {
        if (!self::isGetRequest()) {
            return false;
        }
        self::_verifyParamsGeneric(self::$request["GET"], $params);
    }
    
    # Method to verify if a key is set in an array (do not use)
    private static function _isSetGeneric(array $list, $key) {
        return isset($list, $key);
    }
    
    # Verifies if key is set in GET request
    protected static function isSetPOST($key) {
        return self::_isSetGeneric(self::$request["POST"], $key);
    }

    # Verifies if key is set in GET request
    protected static function isSetGET($key) {
        return self::_isSetGeneric(self::$request["GET"], $key);
    }

    # Verifies if request method is POST
    protected static function isPostRequest() {
        return self::$requestMethod === "POST";
    }
    
    # Verifies if request method is GET
    protected static function isGetRequest() {
        return self::$requestMethod === "GET";
    }
}

?>