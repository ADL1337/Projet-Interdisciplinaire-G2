<?php
require_once __DIR__ . "/../src/framework/core/router.php";

$router = new Router();

# Add routes
/* exemple route
$router->addRoute(["GET"],
                   "/",
                   "HomeController");
*/

$router->matchRoute($_SERVER["REQUEST_URI"]);

?>