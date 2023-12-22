<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_RepairModel.php";

class UserRepairController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireUser();
        if(self::isPostRequest() && self::isSetPOST("bike")){
            RepairModel::repair(self::fetchPOST('bike'));
        }
        $bikes = ReservationModel::getReservedBikes();
        ob_start();
        while($bike = $bikes->fetch()){
            ?>
            <div>
                <form action="" method="post">
                    <?= "{$bike["type_name"]} {$bike["bike_color"]}" ?>
                    <input type="hidden" name="bike" value="<?= $bike["bike_id"] ?>">
                    <input type="submit" value="Repair">
                </form>
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