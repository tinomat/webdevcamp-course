<?php

namespace Controllers;

use Classes\Pagination;
use Model\Category;
use Model\Day;
use Model\Event;
use Model\Hour;
use Model\Speaker;
use MVC\Router;

class EventsController
{
    public static function index(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }

        $current_page = $_GET["page"];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);

        if (!$current_page || $current_page < 1) {
            header("Location:/admin/events?page=1");
        }

        $per_page = 10;
        $total_events = Event::numLogs();
        $pagination = new Pagination($current_page, $per_page, $total_events);

        if ($current_page > $pagination->total_pages()) {
            header("Location: /admin/events?page=1");
        }

        $events = Event::paginate($per_page, $pagination->offset());
        foreach ($events as $event) {
            // Creamos una nueva propiedad en el objeto de evento esta solo se almacena en memoria
            $event->category = Category::find($event->category_id); // recuperamos el objeto de categoria por su id
            // Hacemos lo mismo para las demas columnas donde tengamos un foreign_key
            $event->day = Day::find($event->day_id);
            $event->hour = Hour::find($event->hour_id);
            $event->speaker = Speaker::find($event->speaker_id);
        }

        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops',
            "events" => $events,
            "pagination" => $pagination->pagination()
        ]);
    }
    public static function create(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        $categories = Category::all("ASC");
        $days = Day::all("ASC");
        $hours = Hour::all("ASC");

        $event = new Event;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isAdmin()) {
                header("Location: /login");
            }

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

    public static function edit(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        $categories = Category::all("ASC");
        $days = Day::all("ASC");
        $hours = Hour::all("ASC");

        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $event = Event::find($id);

        if (!$id || !$event) {
            header("Location: /admin/events");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isAdmin()) {
                header("Location: /login");
            }

            $event->sync($_POST);

            $alerts = $event->validate();
            if (empty($alerts)) {

                $res = $event->save();
                if ($res) {
                    header("Location: /admin/events?page=1");
                }
            }
        }
        $alerts = Event::gAlerts();
        $router->render("admin/events/edit", [
            "title" => "Editar evento",
            "alerts" => $alerts,
            "categories" => $categories,
            "days" => $days,
            "hours" => $hours,
            "event" => $event,
        ]);
    }

    public static function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isAdmin()) {
                header("Location: /login");
            }
            $id = $_POST["id"];

            $id = filter_var($id, FILTER_VALIDATE_INT);
            if (!$id) {
                return;
            }

            $event = Event::find($id);

            if ($event) {
                $res = $event->delete();
                if ($res) {
                    header("Location: /admin/events?page=1");
                }
            }
        }
    }
}
