<?php
namespace Core;

class Database {

    private $pdo;
    public function __construct()
    {
        $this->pdo = new \PDO("mysql:host=localhost:8889;dbname=blog", "root", "root", [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function query(string $statement, string $className ,bool $one=false)
    {
        try {
            $query = $this->pdo->query($statement, \PDO::FETCH_CLASS, $className);
            $data = null;
            if ($one) {
                $data = $query->fetch();
            } else {
                $data = $query->fetchAll();
            }
            return $data;
            // header("content-type: Application/json");
            // header("cache-control: public, max-age=1000");
            // echo json_encode($data);
        } catch (\Throwable $th) {
            $message = "Une erreur s'est produite lors de la récupération des informations";
            // header("content-type: Application/json");
            // header("cache-control: public, max-age=1000");
            // echo json_encode($message);
            return $message;
        }
    }

    public function prepare(string $statement, array $data = array())
    {
        try {
            $prepare = $this->pdo->prepare($statement);
            $prepare->execute($data);
            return "Article bien enregistré/modifié";
            // header("content-type: Application/json");
            // header("cache-control: public, max-age=1000");
            // echo json_encode($data);
        } catch (\Exception $e) {
            $message = "Une erreur s'est produite lors de la récupération des informations";
            // header("content-type: Application/json");
            // header("cache-control: public, max-age=1000");
            // echo json_encode($message);
            return $message;
        }
    }
}