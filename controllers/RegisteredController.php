<?php

namespace Controllers;

use MVC\Router;

class RegisteredController
{
    public static function index(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        $router->render('admin/registered/index', [
            'title' => 'Usuarios registrados'
        ]);
    }
}
