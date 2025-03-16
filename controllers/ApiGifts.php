<?php

namespace Controllers;

use Model\Gift;
use Model\Register;

class ApiGifts
{
    public static function index()
    {
        if (!is_admin()) {
            echo json_encode("no chusmees pa");
            return;
        }
        $gifts = Gift::all();

        // Iterar para agregar cantidad de regalos
        foreach ($gifts as $gift) {
            // Buscamos en el registro cuales tienen el regalo
            // Filtramos por el paquete id, nos fijamos que este siempre sea 1, es decir el presencial
            $gift->total = Register::totalArray(["gift_id" => $gift->id, "package_id" => "1"]);
        }
        echo json_encode($gifts);
        return;
    }
}
