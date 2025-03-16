<?php

namespace Controllers;

use Model\Event;
use Model\Package;
use Model\Register;
use Model\User;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        if (!is_admin()) {
            header("Location: /login");
            return;
        }

        // Obtener ultimos registros
        $registers = Register::get(5);
        foreach ($registers as $register) {
            $register->user = User::find($register->user_id);
            $register->package = Package::find($register->package_id);
        }

        // Calcular ingresos
        $virtuals = Register::numLogs("package_id", 2); // 2 = id de paquete virtual
        $presencials = Register::numLogs("package_id", 1); // 1 = id de paquete presencial

        // El numero por el cual multiplicamos la cantidad de virtuales o presenciales es igual a la ganancia neta que obtenemos con paypal, ya sacando las comisiones que cobra la misma
        $earnings = ($virtuals * 46.05) + ($presencials * 187.95);

        // Obtener eventos con más y menos lugares disponibles
        $low_availables = Event::sortLimit("availables", "ASC", 5);
        $high_availables = Event::sortLimit("availables", "DESC", 5);

        $router->render('admin/dashboard/index', [
            'title' => 'Panel de administracion',
            "registers" => $registers,
            "earnings" => $earnings,
            "low_availables" => $low_availables,
            "high_availables" => $high_availables
        ]);
    }
}
