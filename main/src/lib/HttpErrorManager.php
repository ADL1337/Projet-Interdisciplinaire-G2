<?php
require_once __DIR__ . "/RedirectManager.php";

class HttpErrorManager {
    private static string $defaultErrorCode = "500";
    private static array $errorCodes = [ # Most relevant error codes
        "400" => "Bad Request",
        "401" => "Unauthorized",
        "403" => "Forbidden",
        "404" => "Not Found",
        "500" => "Internal Server Error"
    ];

    # Method to get a valid error message
    public static function getErrorMessage(string $errorCode) {
        return self::$errorCodes[self::sanitizeErrorCode($errorCode)];
    }

    # Method to verify an error code is valid
    public static function isValidErrorCode(string $errorCode=null) {
        if (!isset($errorCode)) {
            return false;
        }
        if (key_exists($errorCode, self::$errorCodes)) {
            return true;
        }
        return false;
    }

    # Method to make sure we return a valid error code
    public static function sanitizeErrorCode(string $errorCode) {
        if (self::isValidErrorCode($errorCode)) {
            return $errorCode;
        }
        return self::$defaultErrorCode;
    }

    public static function redirectError(string $errorCode="") {
        $errorCode = self::sanitizeErrorCode($errorCode);
        RedirectManager::redirect("error?code=$errorCode");
    }

    public static function redirectUnauthorized() {
        self::redirectError("401");
    }

    public static function redirectForbidden() {
        self::redirectError("403");
    }

    public static function redirectNotFound() {
        self::redirectError("404");
    }

    public static function redirectInternalError() {
        self::redirectError("500");
    }

    public static function setHttpResponseCode(string $httpResponseCode) {
        http_response_code($httpResponseCode);
    }
}

?>