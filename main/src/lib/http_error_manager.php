<?php

class HttpErrorManager {
    private static string $defaultErrorCode = "500";
    private static array $http_error_codes = [
        "401" => "Unauthorized",
        "404" => "Not Found",
        "500" => "Internal Server Error"
    ];

# Function to get a valid error message
    public static function getErrorMessage(string $error_code) {
        return self::$http_error_codes[self::sanitizeErrorCode($error_code)];
    }

    # Method to verify an error code is valid
    public static function isValidErrorCode(string $error_code) {
        if (key_exists($error_code, self::$http_error_codes)) {
            return true;
        }
        return false;
    }

    # Method to make sure we return a valid error code
    public static function sanitizeErrorCode(string $error_code) {
        if (self::isValidErrorCode($error_code)) {
            return $error_code;
        }
        return self::$defaultErrorCode;
    }
}

?>