<?php

class HttpErrorManager {
    private static string $defaultErrorCode = "500";
    private static array $errorCodes = [ # Most relevant error codes
        "200" => "OK",
        "401" => "Unauthorized",
        "404" => "Not Found",
        "500" => "Internal Server Error"
    ];

    # Method to get a valid error message
    public static function getErrorMessage(string $errorCode) {
        return self::$errorCodes[self::sanitizeErrorCode($errorCode)];
    }

    # Method to verify an error code is valid
    public static function isValidErrorCode(string $errorCode) {
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

    public static function redirectError(string $errorCode) {
        if (self::isValidErrorCode($errorCode)) {
            http_response_code(self::sanitizeErrorCode($errorCode));
            header("Location: error?code=" . self::sanitizeErrorCode($errorCode));
        }
        else {
            header("Location: error?code=404");
        }
        exit();
    }
}

?>