<?php

namespace Controllers;

use MVC\Router;
use Model\Speaker;
// Importacion correcta para manejar las imagenes
use Intervention\Image\ImageManagerStatic as image;
use OutOfRangeException;

class SpeakersController
{
    public static function index(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        $speakers = Speaker::all("ASC");
        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas',
            "speakers" => $speakers
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
    public static function create(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        $speaker = new Speaker;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isAdmin()) {
                header("Location: /login");
            }
            // Leer imagen - importante tener enctype/form-data en el form para que esto funcione
            if (!empty($_FILES["image"]["tmp_name"])) {
                $images_fold = "../public/img/speakers";

                // Crear la carpeta si no existe
                if (!is_dir($images_fold)) {
                    // Creamos la carpeta, pasamos la ruta, los permisos, y el true permite crear subdirectorios de forma recursiva
                    mkdir($images_fold, 0777, true);
                }

                // Formato png
                // Image es de intervention image, una dependencia que descargamos de composer
                $image_png = Image::make($_FILES["image"]["tmp_name"])
                    // indicamos el tamaño
                    ->fit(800, 800)
                    // indicamos el formato y la calidad
                    ->encode("png", 90);
                // Formato webp
                $image_webp = Image::make($_FILES["image"]["tmp_name"])
                    ->fit(800, 800)
                    ->encode("webp", 90);

                // hasheamos el nombre de la imagen, de esta forma evitamos tener dos imagenes con un mismo nombre en la base de datos
                $name_image = md5(uniqid(rand(), true)); // el true en uniqid, aumenta la dificultad del hash

                // Almacenamos en el post el nombre de la imagen
                $_POST["image"] = $name_image;
            }

            // Convertimos el array con las redes en un string, y como esta contiene url formateamos correctamente los slashes (/) para evitar tener problemas a la hora de acceder a las url
            // Reescribimos los datos del campo networks
            $_POST["networks"] = json_encode($_POST["networks"], JSON_UNESCAPED_SLASHES);
            // Sincronizamos objeto con los datos del form
            $speaker->sync($_POST);

            // Validamos los campos
            $alerts = $speaker->validate();

            // Si pasamos la validacion
            if (empty($alerts)) {
                // Guardamos las imagenes
                // con save guardamos la imagen
                $image_png->save(
                    // Le pasamos la ubicacion de la carpeta
                    // El nombre que generamos para la imagen
                    // Y por ultimo su formato
                    $images_fold . "/" . $name_image . ".png"
                );
                $image_webp->save(
                    // Le pasamos la ubicacion de la carpeta
                    // El nombre que generamos para la imagen
                    // Y por ultimo su formato
                    $images_fold . "/" . $name_image . ".webp"
                );

                // Guardar en la base de datos
                $res = $speaker->save();

                if ($res) {
                    header("Location: /admin/speakers");
                }
            }
        }
        $alerts = Speaker::gAlerts();
        $router->render("admin/speakers/create", [
            "title" => "Registrar ponente",
            "alerts" => $alerts,
            "speaker" => $speaker
        ]);
    }
    public static function edit(Router $router)
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        $id = s($_GET["id"]);
        // Validamos que sea un entero
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header("Location: /admin/speakers");
        }
        $speaker = Speaker::find($id);
        if (!$speaker) {
            header("Location: /admin/speakers");
        }
        // Imagen temporal para mostrar a la hora de editar
        $speaker->current_image = $speaker->image;

        // Convertimos el string con las redes a un objeto
        $networks = json_decode($speaker->networks);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isAdmin()) {
                header("Location: /login");
            }
            $images_fold = "../public/img/speakers";
            // Leer imagen - importante tener enctype/form-data en el form para que esto funcione
            if (!empty($_FILES["image"]["tmp_name"])) {
                // Crear la carpeta si no existe
                if (!is_dir($images_fold)) {
                    // Creamos la carpeta, pasamos la ruta, los permisos, y el true permite crear subdirectorios de forma recursiva
                    mkdir($images_fold, 0777, true);
                }
                // Formato png
                // Image es de intervention image, una dependencia que descargamos de composer
                $image_png = Image::make($_FILES["image"]["tmp_name"])
                    // indicamos el tamaño
                    ->fit(800, 800)
                    // indicamos el formato y la calidad
                    ->encode("png", 90);
                // Formato webp
                $image_webp = Image::make($_FILES["image"]["tmp_name"])
                    ->fit(800, 800)
                    ->encode("webp", 90);

                // hasheamos el nombre de la imagen, de esta forma evitamos tener dos imagenes con un mismo nombre en la base de datos
                $name_image = md5(uniqid(rand(), true)); // el true en uniqid, aumenta la dificultad del hash

                // Almacenamos en el post el nombre de la imagen
                $_POST["image"] = $name_image;
            } else {
                // Si no hay una nueva imagen, mantenemos la actual
                $_POST["image"] = $speaker->current_image;
            }
            // Volvemos a convertir en string las redes, para poder almacenarlas en la base de datos
            $_POST["networks"] = json_encode($_POST["networks"], JSON_UNESCAPED_SLASHES);
            $speaker->sync($_POST);

            $alerts = $speaker->validate();

            if (empty($alerts)) {
                // Si se generó un nuevo nombre para la imagen
                if (isset($name_image)) {
                    // Guardamos las imagenes
                    // con save guardamos la imagen
                    $image_png->save(
                        // Le pasamos la ubicacion de la carpeta
                        // El nombre que generamos para la imagen
                        // Y por ultimo su formato
                        $images_fold . "/" . $name_image . ".png"
                    );
                    $image_webp->save(
                        // Le pasamos la ubicacion de la carpeta
                        // El nombre que generamos para la imagen
                        // Y por ultimo su formato
                        $images_fold . "/" . $name_image . ".webp"
                    );
                }
                $res = $speaker->save();
                if ($res) {
                    header("Location: /admin/speakers");
                }
            }
        }
        $alerts = Speaker::gAlerts();
        $router->render("admin/speakers/edit", [
            "title" => "Editar ponente",
            "alerts" => $alerts,
            "speaker" => $speaker,
            "networks" => $networks
        ]);
    }
    public static function delete()
    {
        if (!isAdmin()) {
            header("Location: /login");
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isAdmin()) {
                header("Location: /login");
            }
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $speaker = Speaker::find($id);
            if (!$id || !$speaker) {
                header("Location: /admin/speakers");
            }
            $res = $speaker->delete();
            if ($res) {
                header("Location: /admin/speakers");
            }
        }
    }
}
