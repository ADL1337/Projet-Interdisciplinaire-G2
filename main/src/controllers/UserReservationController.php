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
            <tr>
                <td><?= $reservation["type_name"] ?></td>
                <td><?= $reservation["reservation_start"] ?></td>
                <td><?= $reservation["reservation_end"] ?></td>
            </tr>
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