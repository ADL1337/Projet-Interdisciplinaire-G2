<?php
require_once __DIR__ . "/src/core/router.php";

$router = new Router();

$router->addRoute(["GET"],
                  "/error",
                  "ErrorController");

$router->addRoute(["GET", "POST"],
                  "/login",
                  "LoginController");   

$router->addRoute(["GET"],
                  "/logout",
                  "LogoutController");
                  
$router->matchRoute($_SERVER["REQUEST_URI"]);

?>