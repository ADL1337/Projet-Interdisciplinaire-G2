<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../core/view.php";

class AdminBikeController extends Controller {
    public static function execute(){
        $view = new View("bike_management", "Bike management");
        $vue = $view->generateView([]);
        echo $vue;
    }
}