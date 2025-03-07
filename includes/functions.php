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
    if (!$_SESSION["login"]) {
        header("/");
    }
}

function current_page($path)
{
    return str_contains($_SERVER["PATH_INFO"], $path) ? true : false;
}
