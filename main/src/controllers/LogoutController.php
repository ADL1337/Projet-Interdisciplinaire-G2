<?php
require_once __DIR__ . '/../core/controller.php';


class LogoutController extends Controller {

    public static function execute() {

        session_destroy();

        header("Location: login"); 
        exit();
    }
}
?>
