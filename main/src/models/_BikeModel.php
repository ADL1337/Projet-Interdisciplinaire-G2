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
}
