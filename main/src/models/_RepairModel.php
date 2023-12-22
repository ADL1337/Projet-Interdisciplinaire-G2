<?php
require_once __DIR__ . "/../core/model.php";

class RepairModel extends Model {
    public static function repair($id){
        return;
        $sql = "";
        self::executeRequest($sql, [$id]);
    }

    public static function getRepairBikes(){
        return self::executeRequest("SELECT `repair`.`repair_start`, `repair`.`repair_end`, `type`.`type_name`, `bike`.`bike_color` from `repair` inner join bike on `repair`.bike_id = bike.bike_id INNER JOIN `type` on `type`.`type_id` = `bike`.`bike_type`", []);
    }
}
