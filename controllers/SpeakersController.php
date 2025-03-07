<?php

namespace Controllers;

use MVC\Router;

class SpeakersController
{
    public static function index(Router $router)
    {
        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas'
        ]);
    }
    public static function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /login');
        }
    }
    public static function create(Router $router)
    {
        $alerts = [];
        $router->render("admin/speakers/create", [
            "title" => "Registrar ponente",
            "alerts" => $alerts
        ]);
    }
}
