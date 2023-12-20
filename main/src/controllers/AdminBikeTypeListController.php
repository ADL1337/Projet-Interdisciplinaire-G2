<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";

class AdminBikeTypeListController extends Controller {
    public static function execute(){
        $bikeTypes = BikeModel::getBikeTypes();

        ob_start();
        ?>
        <table>
            <?php
            while($type = $bikeTypes->fetch()){
                ?>
                <tr>
                    <td><?= $type["type_name"] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php
        $bikeTypeList = ob_get_clean();

        $view = new View("bike_type_list_preview", "Bike Types");
        $generatedView = $view->generateView([
            "bikeTypeList" => $bikeTypeList
        ]);
        echo $generatedView;
    }
}