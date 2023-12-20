<?php
require_once __DIR__ . "/src/core/router.php";

$router = new Router();

$router->addRoute(["GET"],
                  "/error",
                  "ErrorController");

$router->matchRoute($_SERVER["REQUEST_URI"]);

?>