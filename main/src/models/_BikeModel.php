<?php
require_once __DIR__ . "/../core/model.php";

class BikeModel extends Model {
    public static function getBikes(){
        $sql = "SELECT `bike`.`bike_id`, `bike`.`bike_color`, `bike`.`bike_size`, `type`.`type_name` from bike INNER JOIN `type` on `type`.`type_id` = bike.bike_type;";
        return self::executeRequest($sql);
    }

    public static function getBikeTypes(){
        $sql = "SELECT `type`.`type_name`, `type`.`type_id` FROM `type`";
        return self::executeRequest($sql);
    }
}
