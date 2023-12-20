<?php
require_once __DIR__ . '/../core/controller.php';
require_once __DIR__ . '/../views/login.php';
require_once __DIR__ . '/../models/login_model.php';

class LoginController extends Controller{
    public static function execute(){
        #$view=new View('login', 'Login');
        #$generate=$view->generateView([
         #   '$test'=>'salut']);
            if ((self::$requestMethod == "POST") && self::isSetPOST('user_email') && self::isSetPOST('user_password')){
                $user_email=self::fetchPOST('user_email');
                $user_password=self::fetchPOST('user_password');
                if ($_POST['user_email'] == false && $_POST['user_password'] == false){
                    HttpErrorManager::redirectError('401');
                }
                elseif (($_POST['user_email'] == true && $_POST['user_password'] == false) or ($_POST['user_email'] == false && $_POST['user_password'] == true)){
                    HttpErrorManager::redirectError('401');
                }
                elseif ($_POST['user_email'] == true && $_POST['user_password'] == true){
                    self::checkUserDb($user_email, $user_password);
                }
            }
        }

    private static function checkUserDb(string $user_email, string $user_password){
        $res = LoginModel::getLogin($user_email);
        $fetchvalue = $res->fetch();
        if (isset ($fetchvalue) AND $fetchvalue != false){
            if (password_verify($user_password, $fetchvalue['user_password'])){
                $_SESSION['user_admin']=$fetchvalue['user_admin'];
                $_SESSION['user_id']=$fetchvalue['user_id'];
            }
        }
    }
        
}
?>