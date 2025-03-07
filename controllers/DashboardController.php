<?php

namespace Controllers;

use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {

        $router->render('admin/dashboard/index', [
            'title' => 'Panel de administracion'
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
