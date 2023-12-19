<?php

class HttpErrorManager {
    private static array $http_error_codes = [
        "401" => "Unauthorized",
        "404" => "Not Found",
        "500" => "Internal Server Error"
    ];

# Function to get a valid error message
    public static function get_error_message(string $error_code) {
        return self::$http_error_codes[sanitize_error_code($error_code)];
    }

    # Method to verify an error code is valid
    public static function isValidErrorCode(string $error_code) {
        echo "these are the error codes ";
        var_dump($http_error_codes);
        if (key_exists($error_code, $http_error_codes)) {
            return true;
        }
        return false;
    }

    # Method to make sure we return a valid error code
    public static function sanitizeErrorCode(string $error_code="500") {
        if (self::isValidErrorCode($error_code)) {
            return $error_code;
        }
        return "500";
    }
}

?>