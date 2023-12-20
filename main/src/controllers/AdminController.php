<?php
require_once __DIR__ . "/../core/controller.php";

class AdminController extends Controller {
    public static function execute(){
        $view = new View("admin", "Administration");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}