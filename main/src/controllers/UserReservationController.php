<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_UserReservationModel.php";
require_once __DIR__ . "/../lib/SessionManager.php";

class UserReservationController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireUser();

        $userReservations = UserReservationModel::getUserReservation(SessionManager::get('user_id'));

        ob_start();
        echo '<section class="reservation bg_user">';
        while($reservation = $userReservations->fetch()){
            ?>
            <div class="reservation_wrapped">
                <div class="review">
                    <h2>Bike</h2>
                    <div class="infos">
                        <div class="tab-reservation-list">Bike type:<br> <?= $reservation["type_name"] ?></div>
                        <div class="tab-reservation-list">Reservation start:<br> <?= $reservation["reservation_start"] ?></div>
                        <div class="tab-reservation-list">Reservation end: <br><?= $reservation["reservation_end"] ?></div>
                    </div>
                </div>
            </div>
            <?php 
        }
        echo '</section>';
        $reservations = ob_get_clean();
        $view = new View("user_reservation", "Reservations");
        $generatedView = $view->generateView([
            "reservations" => $reservations
        ]);
        echo $generatedView;
    }
}