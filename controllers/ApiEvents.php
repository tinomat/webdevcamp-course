<?php

namespace Controllers;

use Model\EventTime;
use MVC\Router;

class ApiEvents
{
    public static function index()
    {
        $category_id = $_GET["category_id"] ?? "";
        $day_id = $_GET["day_id"] ?? "";

        $category_id = filter_var($category_id, FILTER_VALIDATE_INT);
        $day_id = filter_var($day_id, FILTER_VALIDATE_INT);

        if (!$day_id || !$category_id) {
            echo json_encode([]);
            return;
        }

        // Consultar DB
        $events = EventTime::whereArray([
            "category_id" => $category_id,
            "day_id" => $day_id
        ]) ?? [];

        echo json_encode($events);
    }
}
