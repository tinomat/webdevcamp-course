<?php

namespace Controllers;

use Model\Event;
use MVC\Router;

class EventsController
{
    public static function index(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops'
        ]);
    }
    public static function create(Router $router)
    {
        $event = new Event;
        $alerts = [];
        $router->render("admin/events/create", [
            "title" => "Crear un evento",
            "alerts" => $alerts,
            "event" => $event
        ]);
    }
}
