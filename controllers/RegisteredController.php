<?php

namespace Controllers;

use Model\User;
use MVC\Router;
use Model\Register;
use Classes\Pagination;
use Model\Gift;
use Model\Package;

class RegisteredController
{
    public static function index(Router $router)
    {
        if (!is_admin()) {
            header("Location: /login");
        }
        // Obtener pagina actual
        $current_page = s($_GET["page"]);

        // Validamos que sea un entero
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);

        // Si la pagina no es un entero o es menor a 1
        if (!$current_page || $current_page < 1) {
            header("Location: /admin/registered?page=1");
        }

        // Paginacion - Calculo de paginas totales, Registros por pagina - Instancia de paginacion
        $total_pages = Register::numLogs();
        $logs_per_page = 5;
        $pagination = new Pagination($current_page, $logs_per_page, $total_pages);

        // Si la pagina actual es mayor al total de paginas
        if ($current_page > $pagination->total_pages()) {
            header("Location: /admin/registered?page=1");
        }

        $registered = Register::paginate($logs_per_page, $pagination->offset());

        // Cruzamos informacion de las tablas relacionadas
        foreach ($registered as $register) {
            $register->user = User::find($register->user_id);
            $register->package = Package::find($register->package_id);
        }


        $router->render('admin/registered/index', [
            'title' => 'Usuarios registrados',
            "registered" => $registered,
            "pagination" => $pagination->pagination()
        ]);
    }
}
