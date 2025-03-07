<?php

namespace Controllers;

use MVC\Router;

class RegisteredController
{
    public static function index(Router $router)
    {

        $router->render('admin/registered/index', [
            'title' => 'Usuarios registrados'
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
