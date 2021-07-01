<?php
namespace Core\Controller;

class DefaultController {

    public function jsonResponse ($data, $message = "Récupération ok")
    {
        header("content-type: Application/json");
        header("cache-control: public, max-age=1000");
        header("Access-Control-Allow-Origin: *");
        header('HTTP/1.0 200');
        $response = [
            "statusCode" => 200,
            "message" => $message,
            "data" => $data
        ];
        echo json_encode($response);
    }

    public function saveJsonResponse($message = "Enregistrement ok")
    {
        header("content-type: Application/json");
        header("cache-control: no-cache");
        header("Access-Control-Allow-Origin: *");
        header('HTTP/1.0 201');
        $response = [
            "statusCode" => 201,
            "message" => $message
        ];
        echo json_encode($response);
    }

    public function unauthorizedResponse($message = "Unauthorized")
    {
        header("content-type: Application/json");
        header("cache-control: no-cache");
        header("Access-Control-Allow-Origin: *");
        header('HTTP/1.0 401');
        $response = [
            "statusCode" => 401,
            "message" => $message
        ];
        echo json_encode($response);
    }

    public function badRequestJsonResponse($message = "Page not found")
    {
        header("content-type: Application/json");
        header("cache-control: no-cache");
        header("Access-Control-Allow-Origin: *");
        header('HTTP/1.0 404');
        $response = [
            "statusCode" => 404,
            "message" => $message
        ];
        echo json_encode($response);
    }

    public function notAllowedResponse($message = "Method not allowed")
    {
        header("content-type: Application/json");
        header("cache-control: no-cache");
        header("Access-Control-Allow-Origin: *");
        header('HTTP/1.0 405');
        $response = [
            "statusCode" => 405,
            "message" => $message
        ];
        echo json_encode($response);
    }
    
    public function internalErrorResponse ($message = "Internal server error")
    {
        header("content-type: Application/json");
        header("cache-control: no-cache");
        header("Access-Control-Allow-Origin: *");
        header('HTTP/1.0 500');
        $response = [
            "statusCode" => 500,
            "message" => $message
        ];
        echo json_encode($response);
    }

    public function optionResponse($message) 
    {
        header("content-type: Application/json");
        header("cache-control: public, max-age=1000");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Credentials: true");
        header('HTTP/1.0 200');
        $response = [
            "statusCode" => 200,
            "message" => $message
        ];
        echo json_encode($response);
    }

}