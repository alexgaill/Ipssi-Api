<?php 

$path = $_SERVER["PATH_INFO"];

$uri = explode("/", $path);
$entity = ucfirst($uri[1]);
$controller = "App\Controller\\".$entity."Controller";
$cont = new $controller();

// if (isset($uri[2]) && $uri[2] === "create") {
//     $cont->create($_POST);
// } elseif (isset($uri[2]) && preg_match("[\d]", $uri[2])) {
//     if (!isset($uri[3])) {
//         $cont->single($uri[2]);
//     } else {
//         $method = $uri[3];
//         $cont->$method($uri[2]);
//     }
// } elseif (!isset($uri[2])) {
//     $cont->list();
// } else {
//     $cont->badRequestJsonResponse();
// }

$rMethod = $_SERVER["REQUEST_METHOD"];
if ($rMethod === "GET") {
    if (isset($uri[2]) && preg_match("[\d]", $uri[2]) && !isset($uri[3])) {
        $cont->single($uri[2]);
    } elseif (!isset($uri[2])) {
        $cont->list();
    } else {
        $cont->badRequestJsonResponse();
    }
} elseif ($rMethod === "POST") {
    if (isset($uri[2]) && $uri[2] === "create") {
        $cont->create($_POST);
    } else {
        $cont->badRequestJsonResponse("Page not found please try http://localhost:8000/".$uri[1]."/create with method POST.");
        
    }
} elseif ($rMethod === "PUT" || $rMethod === "PATCH") {
    if (isset($uri[2]) && preg_match("[\d]", $uri[2])) {
        if (isset($uri[3]) && $uri[3] === "update") {
            $_PUT = array();
            parse_str(file_get_contents("php://input"), $_PUT);
            $cont->update($uri[2], $_PUT);
        } else {
            $cont->badRequestJsonResponse("Page not found please try http://localhost:8000/".$uri[1]."/{id}/update with method PUT.");
        }
    } else {
        $cont->badRequestJsonResponse("$entity not found please try with another id.");
    }
} elseif ($rMethod === "DELETE") {
    if (isset($uri[2]) && preg_match("[\d]", $uri[2])) {
        if (isset($uri[3]) && $uri[3] === "delete") {
            $cont->delete($uri[2]);
        } else {
            $cont->badRequestJsonResponse("Page not found please try http://localhost:8000/".$uri[1]."/{id}/delete with method DELETE.");
        }
    } else {
        $cont->badRequestJsonResponse("$entity not found please try with another id.");
    }
}

// $map = [
//     "/article" => [new App\Controller\ArticleController, "list"],
//     "/article/create" => [new App\Controller\ArticleController, "create"]
//     "/article/{id}" => [new App\Controller\ArticleController, "create"]
// ];

// $map[$path]();