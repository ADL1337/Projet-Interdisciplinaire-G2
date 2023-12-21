<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";

class AdminBikeListController extends Controller {
    public static function execute(){ 
        PrivilegeMiddleware::requireAdmin();
        $bikes = BikeModel::getBikes();
        ob_start();
        ?>
         <section class="reservation">
            <?php while($bike = $bikes->fetch()){
                ?>
                <div class="reservation_wrapped">
                    <div class="review">
                    <h2>Ready</h2>
                            <div class="infos">
                                <div class="infos">
                                    <div class="li">Bike Type: <?= $bike["type_name"] ?></div>
                                    <div class="li">Bike Color: <?= $bike["bike_color"] ?></div>
                                    <div class="li">Bike Size: <?= $bike["bike_size"] ?></div>
                                    <div class="opgg"><img class="img" src="res/img/bike_manual.svg"></div>
                                </div>
                            </div>
                    </div>
                </div>
                <?php
            } ?>
        </section>
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
