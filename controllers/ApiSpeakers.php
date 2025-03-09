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
}
