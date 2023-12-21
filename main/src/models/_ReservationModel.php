<?php
require_once __DIR__ . "/../core/model.php";

class ReservationModel extends Model {
    public static function reserveBike($id, $from, $end, $userId){
        $sql = "INSERT INTO reservation(reservation_start,reservation_end,bike_id,user_id) VALUES(?,?,?,?)";
        return self::executeRequest($sql, [$from, $end, $id, $userId])->rowCount() == 1;
    }
}
