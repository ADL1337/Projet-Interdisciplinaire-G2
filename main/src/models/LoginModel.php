<?php
require_once __DIR__ . "/../core/model.php";

class LoginModel extends Model{
    # Gets the user
    public static function getUser($user_email){
        $sql = "SELECT user.user_lastname, user.user_firstname, user.user_email, user.user_password, user.user_admin, user.user_id, user.user_reservation 
                FROM user
                WHERE user_email = ?";
        return self::executeRequest($sql, [$user_email]);
    }

    # Method to check if an email is in the DB
    public static function isUserInDB($user_email) {
        $sql = "SELECT 1
                FROM user
                WHERE user_email = ?";
        return (self::executeRequest($sql, [$user_email])->rowCount() === 1); # if rowcount is 1 then user is found in DB
    }
}

?>