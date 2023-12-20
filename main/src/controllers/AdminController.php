<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../core/view.php";

class AdminController extends Controller {
    public static function execute(){
        $view = new View("admin", "Administration");
        $vue = $view->generateView([]);
        echo $vue;
    }
}