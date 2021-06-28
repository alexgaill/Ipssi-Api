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

        } catch (\Throwable $th) {
            return "Une erreur s'est produite lors de la récupération des informations";
        }
    }

    public function prepare(string $statement, array $data = array())
    {
        try {
            $prepare = $this->pdo->prepare($statement);
            $prepare->execute($data);
            return "Article bien enregistré/modifié";

        } catch (\Exception $e) {
            return "Une erreur s'est produite lors de la récupération des informations";
        }
    }
}