<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/StatisticsModel.php";

class AdminStatisticsController extends Controller {
    public static function execute() {
        $totalReservations = StatisticsModel::getTotalReservations();
        $mostReservedBike = StatisticsModel::getMostReservedBike();
        #$mostReservedBikeType = StatisticsModel::getMostReservedBikeType();

            echo "total reservations: ";
            var_dump($totalReservations);
            echo "<br>";

            echo "most popular bike ID: ";
            var_dump($mostReservedBike);
            echo "<br>";
        /*while ($res = $mostReservedBikeType->fetch()) {
            echo "most popular bike type: ";
            var_dump($res);
            echo "<br>";
        }*/
    }
}

?>