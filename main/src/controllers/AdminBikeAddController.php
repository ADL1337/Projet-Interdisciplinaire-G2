<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../core/view.php";
require_once __DIR__ . "/../models/_BikeModel.php";

class AdminBikeAddController extends Controller {
    public static function execute(){ 
        $bikeTypes = BikeModel::getBikeTypes();
        ob_start();
        ?>
        <form action="/addBike" method="post">
            <select name="bike_type" id="">
                <?php while($bikeType = $bikeTypes->fetch()){
                    ?>
                        <option value="<?= $bikeType["type_id"] ?>"><?= $bikeType["type_name"] ?></option>
                    <?php
                } ?>
            </select>
            <label for="size">Size : </label>
            <select name="size" id="size">
                <option value="1">Child</option>
                <option value="2">Teenager</option>
                <option value="3">Adult</option>
            </select>
            <input type="text" name="color" placeholder="color">
        </form>
        <?php
        $listBikeTypes = ob_get_clean();
        $view = new View("bike_add_preview", "Add one bike");
        $test = $view->generateView([
            "listBikeTypes" => $listBikeTypes,
        ]);
        echo $test;
    }
}

?>
