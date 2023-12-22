<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/StatisticsModel.php";

class AdminStatisticsController extends Controller {
    public static function execute() {
        PrivilegeMiddleware::requireAdmin();

        $totalReservations = StatisticsModel::getTotalReservations(); # total reservations
        $mostReservedBike = StatisticsModel::getMostReservedBike(); # Bike ID
        
        $totalBikesReserved = "Total bikes reserved: $totalReservations";
        $mostPopularBike = "Most popular bike: $mostReservedBike";

        $view = new View("statistics", "Statistics");
        $generatedView = $view->generateView([
            "totalBikesReserved" => $totalBikesReserved,
            "mostPopularBike" => $mostPopularBike
        ]);

        echo $generatedView;
    }
}

?>