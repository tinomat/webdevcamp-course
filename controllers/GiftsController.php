<?php

namespace Controllers;

use MVC\Router;

class GiftsController
{
    public static function index(Router $router)
    {

        $router->render('admin/gifts/index', [
            'title' => 'Regalos'
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
