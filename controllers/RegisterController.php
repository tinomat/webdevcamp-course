<?php

namespace Controllers;

use Model\Day;
use Model\Hour;
use Model\User;
use MVC\Router;
use Model\Event;
use Model\Package;
use Model\Speaker;
use Model\Category;
use Model\EventsRegister;
use Model\Gift;
use Model\Register;

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

        // Si existe un registro y este es del plan gratis o virtual, redireccionamos a su ticket correspondiente
        if (isset($register) && ($register->package_id === "3" || $register->package_id === "2")) {
            header("Location: /ticket?id=" . urlencode($register->token));
            return;
        }

        // Si existe un registro y el paquete registrado es el presencial
        if (isset($register) && $register->package_id === "1") {
            header("Location:/finish-register/conferences");
            return;
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
    public static function pay()
    {
        if ($_SERVER["REQUEST_METHOD"]) {
            if (!is_auth()) {
                header("Location: /login");
            }

            // Validar que $_POST no venga vacio
            if (empty($_POST)) {
                // Retornamos json vacío
                echo json_encode([]);
                return;
            }

            // Crear el registro
            // Aplicamos tryCath en caso de algun error, recomendado sobre todo para pagos
            try {
                // Creamos los datos del registro
                $data = $_POST;
                $token = substr(md5(uniqid(rand(), true)), 0, 8);
                $data["token"] = $token;
                $data["user_id"] = $_SESSION["id"];
                // Instanciamos registro
                $register = new Register($data);

                $res = $register->save();
                // Retornamos al frontend (js)
                echo json_encode($res);
            } catch (\Throwable $th) {
                echo json_encode([
                    "res" => $th
                ]);
            }
        }
    }
    public static function conferences(Router $router)
    {
        if (!is_auth()) {
            header("Location:/login");
            return;
        }

        // Validar compra del plan presencial
        $user_id = (int)$_SESSION["id"];

        // Usuario registrado
        $register = Register::where("user_id", $user_id);

        if (isset($register) && $register->package_id !== "1") {
            header("Location: /ticket?id=" . urlencode($register->token));
            return;
        }

        // Paquete presencial
        // Si el usuario no tiene el paquete presencial o no tiene registrado un pago
        if ($register->package_id !== "1" || !$register->pay_id) {
            header("Location:/finish-register");
            return;
        }

        $event_register = EventsRegister::where("register_id", $register->id);
        if (!empty($event_register)) {
            header("Location: /ticket?id=" . urlencode($register->token));
            return;
        }

        // Traemos los eventos ordenados por su hora, desde mas temprano a mas tarde
        $events = Event::sort("hour_id", "ASC");

        $formated_events = [];

        // Creamos referencias
        $days = [
            // Si day_id es uno y category_id uno, la propiedad del array será f_conferences osea las conferencias del viernes
            // Si category_id es dos serán los workshops del viernes
            1 => [
                1 => 'f_conferences',
                2 => 'f_workshops',
            ],
            // Si el day_id es 2 es decir el sabado, y la category_id es 1 la key del array serán las conferencias del sabado
            // si category_id es serán los workshops del sabado
            2 => [
                1 => 's_conferences',
                2 => 's_workshops',
            ],
        ];

        $formated_events = [];

        foreach ($events as $event) {
            // Craemos claves temporales para almacenar los objetos, obteniendolos por su id
            $event->category = Category::find($event->category_id);
            $event->day = Day::find($event->day_id);
            $event->hour = Hour::find($event->hour_id);
            $event->speaker = Speaker::find($event->speaker_id);

            $day_id = $event->day_id;
            $category_id = $event->category_id;
            if (isset($days[$day_id][$category_id])) {
                $key = $days[$day_id][$category_id];
                $formated_events[$key][] = $event;
            }
        }
        $gifts = Gift::all("ASC");

        // Manejar el POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Validar auth
            if (!is_auth()) {
                header("Location: /login");
                return;
            }

            $events = explode(",", $_POST["events"]);

            // En caso de que el arreglo de eventos llegue vacío
            if (empty($events)) {
                echo json_encode(["res" => false]);
                return;
            }

            // Registro del usuario
            $register = Register::where("user_id", $_SESSION["id"]);

            // Si no encontró un registro o no tiene el paquete presencial comprado
            if (!isset($register) || $register->package_id !== "1") {
                echo json_encode(["res" => false]);
                return;
            }

            // Para no realizar dos consultas iguales creamos un array para almacenar los eventos ya filtrados
            $events_arr = [];

            // Validar la disponibilidad de los eventos
            foreach ($events as $event_id) { // events contiene los id de los eventos
                $event = Event::find($event_id);

                // Check que el evento exista y que tenga lugares disponibles
                if (!isset($event) || $event->availables === "0") {
                    echo json_encode(["res" => false]);
                    return;
                }

                // Llenamos el array con los eventos que pasen la validacion
                $events_arr[] = $event;
            }

            // Substraemos los lugares disponibles de los eventos elegidos y guardamos el registro
            // Aca vamos a trabajar con el array ya formateado de los arrays con disponibilidad y existentes
            foreach ($events_arr as $event) {
                // Restamos en uno la cantidad de lugares disponibles para cada evento seleccionado por el usuario
                $event->availables -= 1;
                // Como cada evento va a ser un objeto con el modelo de evento, usamos save para guardar los cambios en cada uno
                $event->save();

                // Almacenar el registro
                $data = [
                    "event_id" => (int) $event->id,
                    "register_id" => (int) $register->id
                ];
                // Creamos la instancia de eventos registros
                $register_user = new EventsRegister($data);
                $register_user->save();
            }
            // Almacenar regalo
            // Sincronizamos el campo de regalo id, con el regalo id que mandamos en post
            $register->sync(["gift_id" => $_POST["gift_id"]]);
            $res = $register->save(); // almacenamos

            // En caso de que se almacene el registro y todo haya salido bien
            if ($res) {
                echo json_encode(
                    [
                        "res" => $res,
                        "token" => $register->token
                    ]
                );
            } else {
                echo json_encode(["res" => false]);
            }
            // Para no renderizar la vista
            return;
        }


        $router->render("register/conferences", [
            "title" => "Elige WorkShops y Conferencias",
            "events" => $formated_events,
            "gifts" => $gifts
        ]);
    }
}
