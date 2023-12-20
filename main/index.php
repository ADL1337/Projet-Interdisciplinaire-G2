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
$router->addRoute(["GET"], "/", "ErrorController");
$router->addRoute(["GET"], "/getBikes", "AdminBikeListController");
$router->addRoute(["GET"], "/addBike", "AdminBikeAddController");
$router->addRoute(["GET", "POST"], "/addBikeType", "AdminBikeTypeAddController");
$router->addRoute(["GET"], "/listBikeType", "AdminBikeTypeListController");

// $router->addRoute(["GET"],
//                   "/",
//                   "ErrorController");


$router->matchRoute($_SERVER["REQUEST_URI"]);

?>