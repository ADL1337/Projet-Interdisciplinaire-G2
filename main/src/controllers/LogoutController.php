<?php
require_once __DIR__ . '/../core/controller.php';

class LogoutController extends Controller {
    public static function execute() {
        SessionManager::destroy(); # Delete user session data 
        header("Location: /login"); # Redirect to login page
        exit();
    }
}
?>
