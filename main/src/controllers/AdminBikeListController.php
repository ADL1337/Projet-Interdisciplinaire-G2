<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";

class AdminBikeListController extends Controller {
    public static function execute(){ 
        $bikes = BikeModel::getBikes();
        ob_start();
        ?>
        <table>
            <?php while($bike = $bikes->fetch()){
                ?>
                <tr>
                    <td><?= $bike["type_name"] ?></td>
                    <td><?= $bike["bike_color"] ?></td>
                    <td><?= $bike["bike_size"] ?></td>
                </tr>
                <?php
            } ?>
        </table>
        <?php
        $listBike = ob_get_clean();
        $view = new View("bike_list_preview", "Bike management");
        $generatedView = $view->generateView([
            "listBike" => $listBike,
        ]);
        echo $generatedView;
    }
}

?>
