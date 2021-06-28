<?php
namespace Core\Controller;

class DefaultController {

    public function jsonResponse ($data)
    {
        header("content-type: Application/json");
        header("cache-control: public, max-age=1000");
        echo json_encode($data);
    }
}