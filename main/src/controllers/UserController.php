<?php
require_once __DIR__ . "/../core/controller.php";

# Controller for the main user's page
class UserController extends Controller {
    public static function execute(){
        # check if the user is logged in as a user
        PrivilegeMiddleware::requireUser();
        # render the user main page
        $view = new View("user", "Isims Park");
        $generatedView = $view->generateView([]);
        echo $generatedView;
    }
}