<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../lib/PrivilegeMiddleware.php";

class AdminBikeController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireAdmin();
        $view = new View("bike_management", "Bike management");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}