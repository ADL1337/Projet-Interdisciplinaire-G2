<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_UserReservationModel.php";
require_once __DIR__ . "/../lib/SessionManager.php";

# Controller for the user's reservation list page
class UserReservationController extends Controller {
    public static function execute(){
        # check if the user is logged in as a user
        PrivilegeMiddleware::requireUser();

        # load users reservation list from database
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

        # render the page with the reservation list
        $view = new View("user_reservation", "Reservations");
        $generatedView = $view->generateView([
            "reservations" => $reservations
        ]);
        echo $generatedView;
    }
}