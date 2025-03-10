<?php

namespace Controllers;

use Model\Category;
use Model\Day;
use Model\Event;
use Model\Hour;
use Model\Speaker;
use MVC\Router;

class PagesController
{

    public static function index(Router $router)
    {

        $router->render("pages/index", [
            "title" => "Inicio",
        ]);
    }
    public static function event(Router $router)
    {
        $router->render("pages/devwebcamp", [
            "title" => "Sobre DevWebCamp",
        ]);
    }
    public static function packages(Router $router)
    {
        $router->render("pages/packages", [
            "title" => "Paquetes DevWebCamp",
        ]);
    }
    public static function conferences(Router $router)
    {

        // Obtenemos los eventos ordenados por su hora de forma ascendente
        $events = Event::sort("hour_id", "ASC");
        $formated_events = [];

        // Creamos referencias
        $days = [
            // Si day_id es uno y category_id uno, la propiedad del array será f_conferences osea las conferencias del viernes
            // Si category_id es dos serán los workshops del viernes
            1 => [
                1 => 'f_conferences',
                2 => 'f_workshops',
            ],
            // Si el day_id es 2 es decir el sabado, y la category_id es 1 la key del array serán las conferencias del sabado
            // si category_id es serán los workshops del sabado
            2 => [
                1 => 's_conferences',
                2 => 's_workshops',
            ],
        ];

        $formated_events = [];

        foreach ($events as $event) {

            // Craemos claves temporales para almacenar los objetos, obteniendolos por su id
            $event->category = Category::find($event->category_id);
            $event->day = Day::find($event->day_id);
            $event->hour = Hour::find($event->hour_id);
            $event->speaker = Speaker::find($event->speaker_id);

            $day_id = $event->day_id;
            $category_id = $event->category_id;
            if (isset($days[$day_id][$category_id])) {
                $key = $days[$day_id][$category_id];
                $formated_events[$key][] = $event;
            }
        }
        $router->render("pages/conferences", [
            "title" => "Conferencias & Workshops",
            "events" => $formated_events
        ]);
    }
}
