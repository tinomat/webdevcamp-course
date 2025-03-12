<?php
function debug($var): string
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

function is_auth(): bool
{
    if (!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['name']) && !empty($_SESSION);
}

function is_admin(): bool
{
    if (!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function current_page($path)
{
    return str_contains($_SERVER["PATH_INFO"] ?? "/", $path) ? true : false;
}

// Funcion para agregar animaciones aleatorias a elementos
function aos_animations()
{
    // Arreglo con las animaciones de scroll de AOS
    $effects = ["fade-up", "fade-down", "fade-left", "fade-right", "flip-left", "flip-right", "zoom-in", "zoom-in-up", "zoom-in-down", "zoom-out"];
    // array_rund, retorna indices aleatorios de un array, le pasamos 1 para que nos retorne un solo indice
    $effect = array_rand($effects, 1);
    echo $effects[$effect];
}
