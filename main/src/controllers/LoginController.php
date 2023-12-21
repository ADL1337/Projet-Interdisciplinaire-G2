<?php
require_once __DIR__ . '/../core/controller.php';
require_once __DIR__ . '/../models/LoginModel.php';

class LoginController extends Controller {
    public static function execute() {
        $params = ["user_email", "user_password"];

        # Verify if all the above parameters are set in the POST request variables
        if (self::verifyParamsPOST($params)) {
            # Data from the login form
            $user_email=self::fetchPOST("user_email");
            $user_password=self::fetchPOST("user_password");
            
            $res = LoginModel::getUser($user_email);
            if ($res->rowCount()=== 1) { # If the user_email matches a user in DB
                $user = $res->fetch();
                if ($user["user_password"] === "") { # DB password empty we try LDAP
                    $logged_in = self::loginLDAP($user_email, $user_password);
                }
                else { # DB password not empty we verify db hash and input password
                    $logged_in = self::loginDB($user_password, $user["user_password"]);
                }
                # Below is the database login, need to implement LDAP login (with empty password)
                if ($logged_in === true) {
                    # Set the attributes to store in session
                    $userAttributes = [
                        "user_id" => $user["user_id"],
                        "user_lastname" => $user["user_lastname"],
                        "user_firstname" => $user["user_firstname"],
                        "user_admin" => $user["user_admin"],
                        "user_email" => $user["user_email"],
                        "user_reservation" => $user["user_reservation"],
                        "logged_in" => true,
                    ];
                    SessionManager::setVariables($userAttributes); # We use the session manager to make SURE the data is consistent
                    if (SessionManager::get("user_admin") == "1") {
                        header("Location: /admin"); # If admin, show admin page
                        exit();
                    }
                    elseif (SessionManager::get("user_admin") == "0") {
                        header("Location: /user"); # If not admin, show user page
                        exit();
                    }
                    else { # Just in case
                        HttpErrorManager::redirectInternalError();
                    }
                }
            } else {
                echo "nope " . $res->rowCount();
            }
        }
        # If GET Request, POST params, or user is not in DB, render login page
        $view = new View("login", "login");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }

    private static function loginLDAP($user_email, $user_password) {
        $dn = Configuration::get("dn");
        $tld = Configuration::get("tld");

        $ldap_server = "LDAP://$dn.$tld";
        $ldap_user = $user_email;

        $ldap_connection = ldap_connect($ldap_server);
    }

    private static function loginDB($user_password, $password_hash) {
        return password_verify($user_password, $password_hash);
    }
}
?>