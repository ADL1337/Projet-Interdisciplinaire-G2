<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../core/view.php";
require_once __DIR__ . "/../models/_BikeModel.php";
require_once __DIR__ . "/ErrorController.php";

class AdminBikeAddController extends Controller {
    public static function execute(){
        if(self::isPostRequest() && self::isSetPOST("bike_type") && self::isSetPOST("size") && self::isSetPOST("color")){
            $type = intval(self::fetchPOST("bike_type"));
            $size = intval(self::fetchPOST("size"));
            $color = self::fetchPOST("color");
            if(is_int($type) && is_int($size) && preg_match("/^[a-zA-Zâàêéèëïîï\ ]{1,}$/", $color) == 1){
                $res = BikeModel::addBike($type, $color, $size);
                if($res == false){
                    ErrorController::setError(500);
                    exit;
                } else {
                    header('Location: /listBikeType');
                    exit;
                }
            }
            ErrorController::setError(500);
            exit;
        }
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
