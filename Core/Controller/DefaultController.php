<?php
namespace Core\Controller;

class DefaultController {

    public function jsonResponse ($data, $message = "Récupération ok")
    {
        header("content-type: Application/json");
        header("cache-control: public, max-age=1000");
        header('HTTP/1.0 200');
        $response = [
            "statusCode" => 200,
            "message" => $message,
            "data" => $data
        ];
        echo json_encode($response);
        // {
        //     statusCode: 200,
        //     message:"ok",
        //     data: []
        // }
    }

    public function saveJsonResponse($message = "Enregistrement ok")
    {
        header("content-type: Application/json");
        header("cache-control: public, max-age=1000");
        header('HTTP/1.0 201');
        $response = [
            "statusCode" => 201,
            "message" => $message
        ];
        echo json_encode($response);
    }

    public function BadRequestJsonResponse($message = "Page not found")
    {
        header("content-type: Application/json");
        header("cache-control: public, max-age=1000");
        header('HTTP/1.0 404');
        $response = [
            "statusCode" => 404,
            "message" => $message
        ];
        echo json_encode($response);
    }
}