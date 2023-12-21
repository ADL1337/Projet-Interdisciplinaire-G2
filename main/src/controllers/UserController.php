<?php
require_once __DIR__ . "/../core/controller.php";

class UserController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireUser();
        $view = new View("user", "Isims Park");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}