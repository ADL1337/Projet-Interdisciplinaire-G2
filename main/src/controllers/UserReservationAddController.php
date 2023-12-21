<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";

class UserReservationAddController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireUser();
        $view = new View("reservation_add_preview", "Reserve your bike now");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}