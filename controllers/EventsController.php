<?php

namespace Controllers;

use Model\Category;
use Model\Day;
use Model\Event;
use Model\Hour;
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
        $categories = Category::all("ASC");
        $days = Day::all("ASC");
        $hours = Hour::all("ASC");


        $alerts = [];
        $router->render("admin/events/create", [
            "title" => "Crear un evento",
            "alerts" => $alerts,
            "categories" => $categories,
            "days" => $days,
            "hours" => $hours
        ]);
    }
}
