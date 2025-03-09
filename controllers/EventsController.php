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

        $event = new Event;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $event->sync($_POST);
            $alerts = $event->validate();

            if (empty($alerts)) {
                $res = $event->save();

                if ($res) {
                    header("Location: /admin/events");
                }
            }
        }

        $alerts = Event::gAlerts();
        $router->render("admin/events/create", [
            "title" => "Crear un evento",
            "alerts" => $alerts,
            "categories" => $categories,
            "days" => $days,
            "hours" => $hours,
            "event" => $event
        ]);
    }
}
