<?php

namespace Controllers;

use Model\Package;
use Model\Register;
use Model\User;
use MVC\Router;

class RegisterController
{
    public static function create(Router $router)
    {
        if (!is_auth()) {
            header("Location: /");
            return;
        }

        // Verificar si el ususario ya está registrado (eligio un plan)
        $register = Register::where("user_id", $_SESSION["id"]);

        // Si existe un registro y este es del plan gratis redireccionamos a su boleto
        if (isset($register) && $register->package_id === "3") {
            header("Location: /ticket?id=" . urlencode($register->token));
        }

        $router->render("register/create", [
            "title" => "Finalizar registro"
        ]);
    }
    public static function free()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Si no está autenticado
            if (!is_auth()) {
                header("Location: /login");
                return;
            }

            // Verificar si el ususario ya está registrado (eligio un plan)
            $register = Register::where("user_id", $_SESSION["id"]);
            // Si existe un registro y este es del plan gratis redireccionamos a su boleto
            if (isset($register) && $register->package_id === "3") {
                header("Location: /ticket?id=" . urlencode($register->token));
                return;
            }

            // Creamos un token (nombre del boleto), pero lo vamos a cortar con substring para que no sea tan largo
            // del hash, cortamos desde el inicio hasta 8 caracteres
            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            // Crear registro
            // Creamos los datos del registro
            $data = [
                "package_id" => 3, // paquete gratis
                "token" => $token,
                "user_id" => $_SESSION["id"] //id del usuario que inicio sesion
            ];

            // Instanciamos registro
            $register = new Register($data);

            $res = $register->save();
            if ($res) {
                // Redireccionamos al ticket
                // Url encode evita los caracteres especiales
                header("Location: /ticket?id=" . urlencode($register->token));
                return;
            }
        }
    }
    public static function ticket(Router $router)
    {
        $id = $_GET["id"];
        if (!$id || !strlen($id) === 8) {
            header("Location: /");
            return;
        }

        $register = Register::where("token", $id);

        if (!$register) {
            header("Location: /");
            return;
        }

        // Cruzar la informacion de las FK
        $register->user = User::find($register->user_id);
        $register->package = Package::find($register->package_id);

        $router->render("register/ticket", [
            "title" => "Asistencia a DevWebCamp",
            "register" => $register
        ]);
    }
}
