<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../lib/HttpErrorManager.php";

# Class that will be used to generate error views
class ErrorController extends Controller {
    private static string $errorCode = "500";
    private static string $errorMessage;

    public static function execute() {
        self::setRequest();
        self::setError(self::fetchGET('code'));
        self::showError(HttpErrorManager::getErrorMessage(self::$errorCode));
    }

    private static function showError() {
        $view = new View("error", self::$errorCode . " " . self::$errorMessage);
        echo $view->generateView(["errorMessage" => self::$errorMessage,
                                  "errorCode" => self::$errorCode]);
    }
    
    # Method that sets the error code and message for the error view
    public static function setError($errorCode) {
        if (!HttpErrorManager::isValidErrorCode($errorCode)) {
            HttpErrorManager::redirectError();
        }
        else {
            self::$errorCode = HttpErrorManager::sanitizeErrorCode($errorCode);   
        }
        self::$errorMessage = HttpErrorManager::getErrorMessage(self::$errorCode);
    }
}

?>