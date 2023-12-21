<?php
require_once __DIR__ . "/SessionManager.php";
require_once __DIR__ . "/HttpErrorManager.php";

class PrivilegeMiddleware {
    public static function requireAdmin() {
        if (!SessionManager::isSet("logged_in") || SessionManager::get("logged_in") !== true) {
            HttpErrorManager::redirectUnauthorized();
        }
        if(!SessionManager::isSet("user_admin") || SessionManager::get("user_admin") != "1") {
            HttpErrorManager::redirectForbidden();
        }
    }

    public static function requireUser() {
        if (!SessionManager::isSet("logged_in") || SessionManager::get("logged_in") !== true) {
            HttpErrorManager::redirectUnauthorized();
        }
        if(!SessionManager::isSet("user_admin") || SessionManager::get("user_admin") != "0") {
            HttpErrorManager::redirectForbidden();
        }
    }
}

?>