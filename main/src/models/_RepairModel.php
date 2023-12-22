<?php
require_once __DIR__ . "/../core/model.php";

class RepairModel extends Model {
    public static function repair($id){
        $sql = "";
        self::executeRequest($sql, [$id]);
    }
}
