<?php
require_once __DIR__ . "/../core/model.php";

class UserReservationModel extends Model{
    # Gets the user's reservations
    public static function getUserReservation($user_id){
        $sql = "SELECT CONCAT(DAY(`reservation`.`reservation_start`), '/', MONTH(`reservation`.`reservation_start`), '/', YEAR(`reservation`.`reservation_start`)) as reservation_start, CONCAT(DAY(`reservation`.`reservation_end`), '/', MONTH(`reservation`.`reservation_end`), '/', YEAR(`reservation`.`reservation_end`)) as reservation_end, `type`.`type_name` from reservation INNER JOIN bike on `reservation`.`bike_id` = `bike`.`bike_id` inner join `type` on `type`.`type_id` = `bike`.`bike_type` where `reservation`.`user_id` = ?";
        return self::executeRequest($sql, [$user_id]);
    }
}

?>