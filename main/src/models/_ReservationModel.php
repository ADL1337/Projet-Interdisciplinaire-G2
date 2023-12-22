<?php
require_once __DIR__ . "/../core/model.php";

class ReservationModel extends Model {
    public static function reserveBike($id, $from, $end, $userId){
        $sql = "INSERT INTO reservation(reservation_start,reservation_end,bike_id,user_id) VALUES(?,?,?,?)";
        return self::executeRequest($sql, [$from, $end, $id, $userId])->rowCount() == 1;
    }

    public static function getReservedBikes(){
        $sql = "SELECT `bike`.`bike_color`, `type`.`type_name`, `bike`.`bike_id` from bike inner join `type` on `type`.`type_id` = `bike`.`bike_type` inner join reservation on `reservation`.`bike_id` = `bike`.`bike_id` WHERE `reservation`.`user_id` = ? and `reservation`.`reservation_start` <= ? and `reservation`.`reservation_end` > ?";
        return self::executeRequest($sql, [SessionManager::get("user_id"), date("Y-n-j"), date("Y-n-j")]);
    }
}
