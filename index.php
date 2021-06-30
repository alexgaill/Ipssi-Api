<?php

use Core\Controller\DefaultController;

require "vendor/autoload.php";

// if (isset($_COOKIE["apikey"]) && $_COOKIE["apikey"] === "845c4f3dd5ec02c3ff0caf3a1a255f9b") {
if (isset($_GET["apikey"]) && $_GET["apikey"] === "845c4f3dd5ec02c3ff0caf3a1a255f9b") {
    require "router/router.php";
} else {
    $controller = new DefaultController;
    $controller->unauthorizedResponse("Apikey manquante");
}