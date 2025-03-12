<?php

namespace Controllers;

use Model\User;
use MVC\Router;
use Classes\Email;
use Model\Register;

class AuthController
{
    public static function login(Router $router)
    {
        if (is_auth()) {
            header("Location: /");
        }
        // Si se registra un metodo post en la url
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Instanciamos un objeto user con los argumentos pasados en el formulario de logeo
            $user = new User($_POST);

            // Validamos los campos
            $alerts = $user->validateLogin();

            // Si no hay alerts (es decir los campos estan OK)
            if (empty($alerts)) {
                // Instanciamos user buscando por el email el cual ingreso el ususario
                $user = User::where("email", $user->email);

                // si el usuario no existe o no está confirmado
                if (!$user || !$user->confirm) {
                    // Mostramos alerta
                    User::sAlert("error", "El usuario no existe o no está confirmado");
                } else { // caso contrario

                    // si la contraseña ingresada coincide con la contraseña del usuario alojado en la base de datos
                    if (password_verify($_POST["password"], $user->password)) {
                        // iniciamos la sesión
                        session_start();
                        // llenamos la variable de sesion con la informacion del usuario logeado
                        $_SESSION["id"] = $user->id;
                        $_SESSION["name"] = $user->name;
                        $_SESSION["lastname"] = $user->lastname;
                        $_SESSION["email"] = $user->email;
                        $_SESSION["admin"] = $user->admin ?? null;

                        if ($user->admin) {
                            header("Location: /admin/dashboard");
                        } else {
                            header("Location: /finish-register");
                        }
                    } else { // caso contrario
                        // mostramos alerta de contraseña incorrecta
                        User::sAlert("error", "Contraseña incorrecta");
                    }
                }
            }
        }
        // instanciamos alertas para pasarlas a la vista
        $alerts = User::gAlerts();

        // renderizamos y pasamos informacion a la vista
        $router->render("auth/login", [
            "title" => "Iniciar Sesion",
            "alerts" => $alerts,
        ]);
    }

    public static function logout()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            $_SESSION = [];
            header("Location: /login");
        }
    }

    public static function register(Router $router)
    {
        // Instanciar user
        $user = new User;
        if (is_auth()) {
            header("Location: /");
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user->sync($_POST);

            $alerts = $user->validateAcc();

            if (empty($alerts)) {
                $userExists = User::where("email", $user->email);

                if ($userExists && $userExists->confirm) {
                    User::sAlert("error", "Email ya registrado");
                } else {
                    $user->hashPassword();

                    unset($user->password2);

                    $user->createToken();

                    $res = $user->save();

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendVerify();
                    if ($res) {
                        header("Location: /message");
                    }
                }
            }
        }
        $alerts = User::gAlerts();
        $router->render("auth/register", [
            "title" => "Crear cuenta",
            "user" => $user,
            "alerts" => $alerts
        ]);
    }


    public static function forgot(Router $router)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new User($_POST);

            $alerts = $user->validateEmail();

            if (empty($alerts)) {
                $user = User::where("email", $user->email);

                if ($user && $user->confirm) {
                    $user->createToken();
                    unset($user->password2);

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendInstructions();

                    $user->save();
                    User::sAlert("success", "Hemos enviado las instrucciones a tu email");
                } else {
                    User::sAlert("error", "El usuario no existe o no está confirmado");
                }
            }
        }

        $alerts = User::gAlerts();
        $router->render("auth/forgot", [
            "title" => "Olvide mi contraseña",
            "alerts" => $alerts
        ]);
    }

    public static function reset(Router $router)
    {
        $token = s($_GET["token"]);
        $valid_token = true;
        if (!$token) {
            header("Location: /");
        }

        $user = User::where("token", $token);

        if (empty($user)) {
            User::sAlert("error", "Token no valido");
            $valid_token = false;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user->sync($_POST);

            $alerts = $user->validatePassword();

            if (empty($alerts)) {
                $user->hashPassword();
                $user->token = "";
                $res = $user->save();
                if ($res) {
                    header("Location: /");
                }
            }
        }
        $alerts = User::gAlerts();
        $router->render("auth/reset", [
            "title" => "Reestablecer contraseña",
            "alerts" => $alerts,
            "valid_token" => $valid_token
        ]);
    }

    public static function message(Router $router)
    {
        $router->render("auth/message", [
            "title" => "Cuenta creada correctamente"
        ]);
    }

    public static function confirm(Router $router)
    {
        $token = s($_GET["token"]);

        if (!$token) {
            header("Location: /");
        }

        $valid_token = true;
        $user = User::where("token", $token);

        if ($user) {
            $user->confirm = 1;
            $user->token = "";

            $res = $user->save();
            if ($res) {
                User::sAlert("success", "Cuenta validada correctamente");
            }
        } else {
            User::sAlert("error", "Token no valido");
            $valid_token = false;
        }

        $router->render("auth/confirm", [
            "title" => "Confirmar cuenta",
            "alerts" => User::gAlerts(),
            "valid_token" => $valid_token
        ]);
    }
}
