<?php

// use App\Controller\ArticleController;

require "vendor/autoload.php";


// $controller = new ArticleController;
// $articles = $controller->list();

// var_dump($_SERVER);
$path = $_SERVER["PATH_INFO"];

// function discover() {
//     echo "discover";
// }

// $anonyme = function () {
//     echo "anonyme";
// };

// class Maclasse{
//     public function methode() {
//         echo "methode";
//     }
// }

// $fonction = [new Maclasse, "methode"];
// $fonction();

$uri = explode("/", $path);
$entity = ucfirst($uri[1]);
$controller = "App\Controller\\".$entity."Controller";
$cont = new $controller();

// var_dump($uri);

// isset($uri[2]) ? var_dump($uri[2]): null ;
if (isset($uri[2]) && $uri[2] === "create") {
    $cont->create();
} elseif (isset($uri[2])) {
    if (!isset($uri[3])) {
        $cont->single($uri[2]);
    } else {
        $method = $uri[3];
        $cont->$method($uri[2]);
    }
} else {
    $cont->list();
}

// $map = [
//     "/article" => [new App\Controller\ArticleController, "list"],
//     "/article/create" => [new App\Controller\ArticleController, "create"]
//     "/article/{id}" => [new App\Controller\ArticleController, "create"]
// ];

// $map[$path]();