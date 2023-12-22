<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";
require_once __DIR__ . "/../lib/HttpErrorManager.php";
require_once __DIR__ . "/../lib/PrivilegeMiddleware.php";

# Controller for the admin's page to add bike
class AdminBikeAddController extends Controller {
    public static function execute(){
        # check if the user is logged in and if he's an admin user
        PrivilegeMiddleware::requireAdmin();

        # if it's a post request and all the fields are settled
        if(self::isPostRequest() && self::isSetPOST("bike_type") && self::isSetPOST("size") && self::isSetPOST("color")){
            $type = intval(self::fetchPOST("bike_type"));
            $size = intval(self::fetchPOST("size"));
            $color = self::fetchPOST("color");

            # check if all the value are in the correct type and format
            if(is_int($type) && is_int($size) && preg_match("/^[a-zA-Zâàêéèëïîï\ ]{1,}$/", $color) == 1){
                $res = BikeModel::addBike($type, $color, $size);

                # if the insert is unsuccessful we redirect to the error page
                if($res == false){
                    HttpErrorManager::redirectError("500");
                # But if the insert is successful, we redirect to the bike list
                } else {
                    header('Location: /listBike');
                    exit();
                }
            }

            # if he didn't got redirected it means the request is not correct
            HttpErrorManager::redirectError("500");
        }
        $bikeTypes = BikeModel::getBikeTypes();
        ob_start();
        while($bikeType = $bikeTypes->fetch()){
            ?>
                <option value="<?= $bikeType["type_id"] ?>"><?= $bikeType["type_name"] ?></option>
            <?php
        }
        $listBikeTypes = ob_get_clean();

        # we generate the view and we show it
        $view = new View("bike_add_preview", "Add one bike");
        $generatedView = $view->generateView([
            "listBikeTypes" => $listBikeTypes,
        ]);
        echo $generatedView;
    }
}

?>
