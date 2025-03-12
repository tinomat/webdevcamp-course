<?php

namespace Controllers;

use MVC\Router;

class GiftsController
{
    public static function index(Router $router)
    {
        if (!is_admin()) {
            header("Location: /login");
        }
        $router->render('admin/gifts/index', [
            'title' => 'Regalos'
        ]);
    }
}
