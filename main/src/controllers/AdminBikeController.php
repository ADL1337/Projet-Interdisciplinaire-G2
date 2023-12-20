<?php
require_once __DIR__ . "/../core/controller.php";

class AdminBikeController extends Controller {
    public static function execute(){
        $view = new View("bike_management", "Bike management");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}