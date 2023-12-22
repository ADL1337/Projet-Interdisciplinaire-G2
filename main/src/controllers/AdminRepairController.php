<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_RepairModel.php";

class AdminRepairController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireAdmin();
        $bikes = RepairModel::getRepairBikes();
        ob_start();
        ?>
        <?php
        while($bike = $bikes->fetch()){
            ?>
            <div>
                Bike : <?= "{$bike["type_name"]} {$bike["bike_color"]}" ?> <br>
                Reparation date : <?= "{$bike["repair_start"]}" ?> <br>
                Reparation end date : <?= "{$bike["repair_end"]}" ?> <br>
                <hr />
            </div>
            <?php
        }
        ?>
        <?php
        $bikeHTML = ob_get_clean();
        $view = new View("admin_repair", "Bikes");
        $generatedView = $view->generateView([
            "repair" => $bikeHTML
        ]);
        echo $generatedView;
    }
}