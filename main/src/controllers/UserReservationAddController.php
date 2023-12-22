<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";
require_once __DIR__ . "/../models/_ReservationModel.php";
require_once __DIR__ . "/../lib/HttpErrorManager.php";


class UserReservationAddController extends Controller {
    public static function execute(){
        PrivilegeMiddleware::requireUser();
        if(self::isPostRequest() && self::isSetGET("date_from") && self::isSetGET("date_end") && self::isSetPOST("bike")){
            $bike = self::fetchPOST("bike");
            $dateFrom = self::fetchGET("date_from");
            $dateEnd = self::fetchGET("date_end");
            if(preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $dateFrom) and preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $dateEnd)){
                if(BikeModel::doesBikeExist($bike)){
                    if(ReservationModel::reserveBike($bike, $dateFrom, $dateEnd, SessionManager::get("user_id"))){
                        header('Location: /reservationList');
                        exit();
                    }
                }
            }
            HttpErrorManager::redirectError("400");
        }
        $bikeHTML = null;
        if(self::isSetGET("date_from") && self::isSetGET("date_end")){
            $dateFrom = self::fetchGET("date_from");
            $dateEnd = self::fetchGET("date_end");
            if(preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $dateFrom) and preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $dateEnd)){
                $bikes = BikeModel::getBikesForDate($dateFrom, $dateEnd);
                ob_start();
                while ($bike = $bikes->fetch()) {
                    ?>
                    <option value="<?= $bike["bike_id"] ?>"><?= "{$bike['type_name']} {$bike['bike_color']}" ?></option>
                    <?php
                }
                $bikeHTML = ob_get_clean();
            }
        }
        $view = new View("reservation_add_preview", "Reserve your bike now");
        $generatedView = $view->generateView([
            "today" => date("Y-n-j"),
            "bike" => $bikeHTML,
            "dateFrom" => isset($dateFrom) ? $dateFrom : "",
            "dateEnd" => isset($dateEnd) ? $dateEnd : "",
        ]);
        echo $generatedView;
    }
}