<?php

require_once __DIR__ . "/../includes/app.php";

use Controllers\ApiEvents;
use Controllers\ApiSpeakers;
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
$router->post('/logout', [AuthController::class, 'logout']);

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

// Speakers
$router->get("/admin/speakers", [SpeakersController::class, "index"]);

$router->get("/admin/speakers/create", [SpeakersController::class, "create"]);
$router->post("/admin/speakers/create", [SpeakersController::class, "create"]);

$router->get("/admin/speakers/edit", [SpeakersController::class, "edit"]);
$router->post("/admin/speakers/edit", [SpeakersController::class, "edit"]);

$router->post("/admin/speakers/delete", [SpeakersController::class, "delete"]);

// Events
$router->get("/admin/events", [EventsController::class, "index"]);
$router->get("/admin/events/create", [EventsController::class, "create"]);
$router->post("/admin/events/create", [EventsController::class, "create"]);

// API's
$router->get("/api/events-time", [ApiEvents::class, "index"]);
$router->get("/api/speakers", [ApiSpeakers::class, "index"]);


// Registered users
$router->get("/admin/registered", [RegisteredController::class, "index"]);


// Gifts
$router->get("/admin/gifts", [GiftsController::class, "index"]);

$router->checkRoutes();
