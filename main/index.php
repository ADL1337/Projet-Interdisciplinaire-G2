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

$router->addRoute(["GET"], "/", "LoginController");
$router->addRoute(["GET", "POST"], "/addBike", "AdminBikeAddController");
$router->addRoute(["GET"], "/listBike", "AdminBikeListController");
$router->addRoute(["GET", "POST"], "/addBikeType", "AdminBikeTypeAddController");
$router->addRoute(["GET"], "/listBikeType", "AdminBikeTypeListController");
$router->addRoute(["GET"], "/bikeManagement", "AdminBikeController");
$router->addRoute(["GET"], "/admin", "AdminController");
$router->addRoute(["GET"], "/user", "UserController");
$router->addRoute(["GET"], "/reservationList", "UserReservationController");
$router->addRoute(["GET"], "/reservation", "UserReservationAddController");

$router->addRoute(["GET"], "/reservationConfirmation", "AdminReservationController");
$router->addRoute(["GET"], "/statistics", "AdminStatisticController");

// $router->addRoute(["GET"],
//                   "/",
//                   "ErrorController");


$router->matchRoute($_SERVER["REQUEST_URI"]);

?>