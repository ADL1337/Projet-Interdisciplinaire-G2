<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../core/view.php";
require_once __DIR__ . "/../models/_BikeModel.php";

class AdminBikeAddController extends Controller {
    public static function execute(){ 
        $bikeTypes = BikeModel::getBikeTypes();
        ob_start();
        while($bikeType = $bikeTypes->fetch()){
            ?>
                <option value="<?= $bikeType["type_id"] ?>"><?= $bikeType["type_name"] ?></option>
            <?php
        }
        $listBikeTypes = ob_get_clean();
        $view = new View("bike_add_preview", "Add one bike");
        $test = $view->generateView([
            "listBikeTypes" => $listBikeTypes,
        ]);
        echo $test;
    }
}

?>
