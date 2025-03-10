<?php

namespace Controllers;

use Model\Speaker;

class ApiSpeakers
{
    public static function index()
    {
        $speakers = Speaker::all();
        echo json_encode($speakers);
    }
    public static function speaker()
    {
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id || $id < 1) {
            echo json_encode([]);
            return;
        }

        $speaker = Speaker::find($id);
        // Formateamos strings con las url de las redes sociales
        echo json_encode($speaker, JSON_UNESCAPED_SLASHES);
    }
}
