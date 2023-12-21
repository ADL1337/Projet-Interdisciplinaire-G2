<?php

# Class that provides an interface for interacting with the $_SESSION variable
class SessionManager {

    private static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private static function _set($key, $value) {
        $_SESSION[$key] = $value;
    }

    private static function _get($key) {
        return $_SESSION[$key];
    }

    public static function set($key, $value) {
        self::start();
        self::_set($key, $value);
    }

    public static function get($key) {
        self::start();
        return self::_get($key);
    }

    public static function isSet($key) {
        self::start();
        if (!isset($_SESSION[$key])) {
            return false;
        }
        return true;
    }

    public static function setVariables(array $variables) {
        self::start();
        foreach ($variables as $key => $value) {
            self::_set($key, $value);
        }
    }

    public static function getVariables() {
        self::start();
        return $_SESSION;
    }

    public static function destroy() {
        self::start();
        session_destroy();
    }
}

?>