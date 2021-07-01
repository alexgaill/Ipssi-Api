<?php 

$path = $_SERVER["PATH_INFO"];
define("SERVER", $_SERVER["HTTP_HOST"]."/");

$uri = explode("/", $path);
$entity = ucfirst($uri[1]);
$controller = "App\Controller\\".$entity."Controller";
$cont = new $controller();

$rMethod = $_SERVER["REQUEST_METHOD"];

if($rMethod === "OPTIONS") {
    $cont->optionResponse("ok");
}

if ($rMethod === "GET") {
    if (isset($uri[2]) && preg_match("[\d]", $uri[2]) && !isset($uri[3])) {
        $cont->single($uri[2]);
    } elseif (!isset($uri[2])) {
        $cont->list();
    } else {
        $cont->badRequestJsonResponse();
    }
} elseif ($rMethod === "POST") {
    // var_dump($role);
    if (isset($uri[2]) && $uri[2] === "create" && in_array("author", $role)) {
        $cont->create($_POST);
    } elseif (isset($uri[2]) && $uri[1] === "user" && $uri[2] === "login") {
        $cont->login($_POST);
    }
    else {
        $cont->notAllowedResponse("Page not found please try ".SERVER.$uri[1]."/create with method POST.");
        
    }
} elseif ($rMethod === "PUT" || $rMethod === "PATCH") {
    if (isset($uri[2]) && preg_match("[\d]", $uri[2])) {
        if (isset($uri[3]) && $uri[3] === "update" && in_array("author", $role)) {
            $_PUT = array();
            parse_str(file_get_contents("php://input"), $_PUT);
            $cont->update($uri[2], $_PUT);
        } else {
            $cont->notAllowedResponse("Page not found please try ".SERVER.$uri[1]."/{id}/update with method PUT.");
        }
    } else {
        $cont->badRequestJsonResponse("$entity not found please try with another id.");
    }
} elseif ($rMethod === "DELETE") {
    if (isset($uri[2]) && preg_match("[\d]", $uri[2])) {
        if (isset($uri[3]) && $uri[3] === "delete" && in_array("author", $role)) {
            $cont->delete($uri[2]);
        } else {
            $cont->notAllowedResponse("Page not found please try ".SERVER .$uri[1]."/{id}/delete with method DELETE.");
        }
    } else {
        $cont->badRequestJsonResponse("$entity not found please try with another id.");
    }
}
