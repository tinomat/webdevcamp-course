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

function isAuth()
{
    session_start();
    return isset($_SESSION["name"]) && !empty($_SESSION);
}
function isAdmin()
{
    session_start();
    return isset($_SESSION["admin"]) && !empty($_SESSION["admin"]);
}

function isLogin()
{
    session_start();
    if ($_SESSION["admin"]) {
        header("Location: /admin/dashboard");
    } else {
        header("Location: /");
    }
}

function current_page($path)
{
    return str_contains($_SERVER["PATH_INFO"], $path) ? true : false;
}
