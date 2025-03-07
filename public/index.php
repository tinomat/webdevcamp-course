<?php

require_once __DIR__ . "/../includes/app.php";

use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventsController;
use Controllers\GiftsController;
use Controllers\RegisteredController;
use Controllers\SpeakersController;

$router = new Router();


// Login
$router->get("/login", [AuthController::class, "login"]);
$router->post("/login", [AuthController::class, "login"]);

// Create Acc
$router->get("/register", [AuthController::class, "register"]);
$router->post("/register", [AuthController::class, "register"]);

// Forgot password
$router->get("/forgot", [AuthController::class, "forgot"]);
$router->post("/forgot", [AuthController::class, "forgot"]);

// Reset password
$router->get("/reset", [AuthController::class, "reset"]);
$router->post("/reset", [AuthController::class, "reset"]);

// Message
$router->get("/message", [AuthController::class, "message"]);

// Confirm acc
$router->get("/confirm", [AuthController::class, "confirm"]);
$router->post("/confirm", [AuthController::class, "confirm"]);


// Admin Dashboard
$router->get("/admin/dashboard", [DashboardController::class, "index"]);
$router->post("/admin/dashboard", [DashboardController::class, "logout"]);
// Speakers
$router->get("/admin/speakers", [SpeakersController::class, "index"]);
$router->get("/admin/speakers/create", [SpeakersController::class, "create"]);
// Events
$router->get("/admin/events", [EventsController::class, "index"]);
// Registered users
$router->get("/admin/registered", [RegisteredController::class, "index"]);
// Gifts
$router->get("/admin/gifts", [GiftsController::class, "index"]);


$router->checkRoutes();
