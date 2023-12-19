<?php
require_once __DIR__ . "/../core/controller.php";
require_once __DIR__ . "/../core/view.php";

class admin extends Controller {
    public static function execute(){ 
        $view = new View("bike_preview", "Bike management");
        $test = $view->generateView([
            "title" => "Bonjour"
        ]);
        echo $test;
    }
}
?>
