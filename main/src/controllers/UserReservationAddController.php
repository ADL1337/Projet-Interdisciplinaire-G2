<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../models/_BikeModel.php";
require_once __DIR__ . "/../models/_ReservationModel.php";
require_once __DIR__ . "/../lib/HttpErrorManager.php";

# Controller for the user's page to make a reservation for a bike
class UserReservationAddController extends Controller {
    public static function execute(){
        # check if the user is logged in as a user
        PrivilegeMiddleware::requireUser();

        # check if it is a post request and if all the parameters needed are in the request
        # some parameters are given as GET parameters as it's already present for the rest of the code
        if(self::isPostRequest() && self::isSetGET("date_from") && self::isSetGET("date_end") && self::isSetPOST("bike")){
            $bike = self::fetchPOST("bike");
            $dateFrom = self::fetchGET("date_from");
            $dateEnd = self::fetchGET("date_end");

            # check if both dateFrom and dateEnd are in a date format
            if(preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $dateFrom) and preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/", $dateEnd)){

                # check if the bike exist (in case someone modify the value in the form)
                if(BikeModel::doesBikeExist($bike)){

                    # if the reservation is successful the user is redirected to the list of all his reservation
                    if(ReservationModel::reserveBike($bike, $dateFrom, $dateEnd, SessionManager::get("user_id"))){
                        header('Location: /reservationList');
                        exit();
                    # but if the reservation is not successful, we redirect to the error page
                    } else {
                        HttpErrorManager::redirectInternalError();
                    }
                }
            }

            # if the code load here, it means the user changed manually some values so we redirect him to the error page
            HttpErrorManager::redirectError("400");
        }

        $bikeHTML = null;

        # if the date is present in the GET parameters, it means they submitted the first form with the date selection
        if(self::isSetGET("date_from") && self::isSetGET("date_end")){
            $dateFrom = self::fetchGET("date_from");
            $dateEnd = self::fetchGET("date_end");

            # check if both dateFrom and dateEnd are in a date format
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

        # Render the reservation form
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