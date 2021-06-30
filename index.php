<?php

use Core\Controller\DefaultController;
use Firebase\JWT\JWT;

require "vendor/autoload.php";

// if (isset($_COOKIE["apikey"]) && $_COOKIE["apikey"] === "845c4f3dd5ec02c3ff0caf3a1a255f9b") {
if (isset($_GET["apikey"]) && $_GET["apikey"] === "845c4f3dd5ec02c3ff0caf3a1a255f9b") {
    $role = array("ROLE_USER");
    if (isset($_COOKIE["jwToken"])) {
        $jwt = $_COOKIE["jwToken"];
        $decoded = JWT::decode($jwt, "toto", array('HS256'));
        $role = array_merge($role, json_decode($decoded->roles));
    }
    require "router/router.php";
} else {
    $controller = new DefaultController;
    $controller->unauthorizedResponse("Apikey manquante");
}