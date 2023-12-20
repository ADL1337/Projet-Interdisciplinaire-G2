<?php
require_once __DIR__ . "/src/core/router.php";

$router = new Router();

# Add routes
/* exemple route
$router->addRoute(["GET"],
                   "/",
                   "HomeController");
*/

# Test route
$router->addRoute(["GET"], "/", "LoginController");
#$router->addRoute(["GET"],"/boubou", "LoginController");

// $router->addRoute(["GET"],
//                   "/",
//                   "ErrorController");


$router->matchRoute($_SERVER["REQUEST_URI"]);

?>