<?php

namespace Controllers;

use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        if (!is_admin()) {
            header("Location: /login");
        }
        $router->render('admin/dashboard/index', [
            'title' => 'Panel de administracion'
        ]);
    }
}
