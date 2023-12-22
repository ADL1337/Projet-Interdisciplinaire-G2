<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_UserReservationModel.php";
require_once __DIR__ . "/../lib/SessionManager.php";

class UserReservationController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireUser();

        $userReservations = UserReservationModel::getUserReservation(SessionManager::get('user_id'));

        ob_start();
        while($reservation = $userReservations->fetch()){
            ?>
            <div class="user-reservation-wrapped">
                <div class="tab"><?= $reservation["type_name"] ?></div>
                <div class="tab"><?= $reservation["reservation_start"] ?></div>
                <div class="tab"><?= $reservation["reservation_end"] ?></div>
            </div>
            <?php
        }

        $reservations = ob_get_clean();
        $view = new View("user_reservation", "Reservations");
        $generatedView = $view->generateView([
            "reservations" => $reservations
        ]);
        echo $generatedView;
    }
}