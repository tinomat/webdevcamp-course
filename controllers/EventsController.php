<?php

namespace Controllers;

use MVC\Router;

class EventsController
{
    public static function index(Router $router)
    {

        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops'
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
}
