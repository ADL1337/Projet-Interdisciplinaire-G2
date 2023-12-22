<?php
require_once __DIR__ . "/../core/model.php";

class BikeModel extends Model {
    public static function getBikes(){
        $sql = "SELECT `bike`.`bike_id`, `bike`.`bike_color`, `bike`.`bike_size`, `type`.`type_name` from bike INNER JOIN `type` on `type`.`type_id` = bike.bike_type ORDER BY `bike`.`bike_purchase_date` ASC;";
        return self::executeRequest($sql);
    }

    public static function getBikeTypes(){
        $sql = "SELECT `type`.`type_name`, `type`.`type_id` FROM `type`";
        return self::executeRequest($sql);
    }

    public static function addBikeType($typeLabel){
        $sql = "INSERT INTO `type` (`type_name`) VALUES (?)";
        return self::executeRequest($sql, [$typeLabel]);
    }

    public static function addBike($bikeType, $bikeColor, $bikeSize){
        $types = self::getBikeTypes();
        $typeExist = false;
        while($type = $types->fetch()){
            if($type['type_id'] == $bikeType){
                $typeExist = true;
                break;
            }
        }
        if($typeExist){
            $sql = "INSERT INTO `bike`(`bike_color`,`bike_size`,`bike_type`, `bike_purchase_date`) VALUES (?, ?, ?, ?)";
            $t = self::executeRequest($sql, [$bikeColor,$bikeSize,$bikeType, date("Y-n-j")]);
            return $t;
        } else {
            return false;
        }
    }

    public static function getBikesForDate($from, $end){
        $sql = "SELECT `bike`.`bike_id`, `bike`.`bike_color`, `bike`.`bike_size`, `type`.`type_name` from bike LEFT JOIN reservation on reservation.bike_id = bike.bike_id INNER JOIN `type` on `type`.`type_id` = `bike`.`bike_type` WHERE `reservation`.`reservation_start` > ? or `reservation`.`reservation_end` < ? or `reservation`.`reservation_id` is null";
        return self::executeRequest($sql, [$from, $end]);
    }

    public static function doesBikeExist($id){
        $sql = "SELECT COUNT(*) as count from bike where bike_id = ?";
        $res = self::executeRequest($sql, [$id]);
        return $res->rowCount() == 1;
    }
}
