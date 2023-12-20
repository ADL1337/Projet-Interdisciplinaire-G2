<?php
require_once __DIR__ . "/SessionManager.php";
require_once __DIR__ . "/HttpErrorManager.php";

class PrivilegeMiddleware {
    public static function requireAdmin() {
        if (!SessionManager::isSet("logged_in") || SessionManager::get("logged_in") !== true) {
            HttpErrorManager::redirectUnauthorized();
        }
        if(!SessionManager::isSet("is_admin") || SessionManager::get("is_admin") !== true) {
            HttpErrorManager::redirectForbidden();
        }
    }

    public static function requireUser() {
        if (!SessionManager::isSet("logged_in") || SessionManager::get("logged_in") !== true) {
            HttpErrorManager::redirectUnauthorized();
        }
        if(!SessionManager::isSet("is_admin") || SessionManager::get("is_admin") !== false) {
            HttpErrorManager::redirectForbidden();
        }
    }
}

?>