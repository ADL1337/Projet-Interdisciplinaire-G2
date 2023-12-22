<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/StatisticsModel.php";

class AdminStatisticsController extends Controller {
    public static function execute() {
        $totalReservations = StatisticsModel::getTotalReservations(); # total reservations
        $mostReservedBike = StatisticsModel::getMostReservedBike(); # array with ["bike_id" and "bike_usage_count"]
        $mostReservedBikeID = $mostReservedBike["bike_id"];
        $mostReservedBikeUsageCount = $mostReservedBike["bike_usage_count"];
        
        $totalBikesReserved = "Total bikes reserved: $totalReservations";
        $mostPopularBike = "Most popular bike: $mostReservedBikeID with $mostReservedBikeUsageCount reservations";

        $view = new View("statistics", "Statistics");
        $generatedView = $view->generateView([
            "totalBikesReserved" => $totalBikesReserved,
            "mostPopularBike" => $mostPopularBike
        ]);

        echo $generatedView;
    }
}

?>