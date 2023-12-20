<?php
require_once __DIR__ . "/../core/model.php";

class LoginModel extends Model{
    public static function getLogin($user_email){
        $sql="SELECT user.user_email, user.user_password, user.user_admin, user.user_id FROM user WHERE user_email=?";
        return self::executeRequest($sql, [$user_email]);
    }
}









?>