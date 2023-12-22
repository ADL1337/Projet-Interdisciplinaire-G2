<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_ReservationModel.php";

class UserRepairController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireUser();
        $bikes = ReservationModel::getReservedBikes();
        ob_start();
        while($bike = $bikes->fetch()){
            ?>
            <div>
                <?= "{$bike["type_name"]} {$bike["bike_color"]}" ?>
                <a href="?bike=<?= $bike["bike_id"] ?>"></a>
            </div>
            <?php
        }
        $bikeHTML = ob_get_clean();
        $view = new View("user_repair", "Repair my bike");
        $generatedView = $view->generateView([
            "bike" => $bikeHTML
        ]);
        echo $generatedView;
    }
}