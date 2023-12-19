<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../lib/http_error_manager.php";


# Class that will be used to generate error views
class ErrorController extends Controller {
    private static string $errorCode = "500";
    private static string $errorMessage;

    public static function execute() {
        self::showError(get_error_message(self::$errorCode));
    }

    private static function showError() {
        $view = new View("error", self::$errorCode . " " . self::$errorMessage);
        echo $view->generateView(["errorMessage" => self::$errorMessage]);
    }
    
    public static function setError($errorCode) {
        self::$errorCode = sanitize_error_code($errorCode);
        self::$errorMessage = get_error_message(self::$errorCode);
    }
}

?>