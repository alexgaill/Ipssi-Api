<?php 

$path = $_SERVER["PATH_INFO"];

$uri = explode("/", $path);
$entity = ucfirst($uri[1]);
$controller = "App\Controller\\".$entity."Controller";
$cont = new $controller();

if (isset($uri[2]) && $uri[2] === "create") {
    $cont->create($_POST);
} elseif (isset($uri[2]) && preg_match("[\d]", $uri[2])) {
    if (!isset($uri[3])) {
        $cont->single($uri[2]);
    } else {
        $method = $uri[3];
        $cont->$method($uri[2]);
    }
} elseif (!isset($uri[2])) {
    $cont->list();
} else {
    $cont->badRequestJsonResponse();
}

// $map = [
//     "/article" => [new App\Controller\ArticleController, "list"],
//     "/article/create" => [new App\Controller\ArticleController, "create"]
//     "/article/{id}" => [new App\Controller\ArticleController, "create"]
// ];

// $map[$path]();