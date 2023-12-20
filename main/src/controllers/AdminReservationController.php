<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_ReservationModel.php";

class AdminReservationController extends Controller {
    public static function execute(){
        $view = new View("bike_management", "Bike management");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}