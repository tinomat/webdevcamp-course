<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;

require __DIR__ . "/../vendor/autoload.php";

// Add DotenV
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();


require "functions.php";
require "database.php";

// Conect DB
ActiveRecord::setDB($db);
