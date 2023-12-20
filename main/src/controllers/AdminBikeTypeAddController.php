<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";

class AdminBikeTypeAddController extends Controller {
    public static function execute(){
        $typeLabel = self::fetchPOST("bike_label");
        if(isset($typeLabel) && !empty($typeLabel) && preg_match("/^[a-zA-Zâàêéèëïîï\ ]{1,}$/", $typeLabel) == 1){
            $res = BikeModel::addBikeType($typeLabel);
            if($res->rowCount() == 1){
                header('Location: /listBikeType');
                exit();
            }
        }
        $view = new View("bike_type_add_preview", "Add a bike");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}