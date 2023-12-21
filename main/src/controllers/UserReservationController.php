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
        while($reservation = $userReservations->fetch()){
            ?>
            <tr>
                <td><?= $reservation["type_name"] ?></td>
                <td><?= $reservation["reservation_start"] ?></td>
                <td><?= $reservation["reservation_end"] ?></td>
            </tr>
            <?php
        }

        $reservations = ob_get_clean();

        # render the page with the reservation list
        $view = new View("user_reservation", "Reservations");
        $generatedView = $view->generateView([
            "reservations" => $reservations
        ]);
        echo $generatedView;
    }
}