<?php
namespace App\Model;

use Core\Database;
use App\Entity\Categorie;

class CategorieModel {

    private $className = "App\Entity\Categorie";

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * return list of Categories
     *
     * @return Categorie[]
     */
    public function findAll() :array
    {
        $statement = "SELECT * FROM categorie";
        return $this->db->query($statement, $this->className);
    }

    /**
     * Return an Categorie
     *
     * @param int $id
     * @return Categorie
     */
    public function find(int $id) :Categorie
    {
        $statement = "SELECT * FROM categorie WHERE id = $id";
        return $this->db->query($statement, $this->className, true);
    }

    public function create(array $data)
    {
        $statement = "INSERT INTO categorie (name) 
            VALUES (:name)";
        return $this->db->prepare($statement, $data);
    }

    public function update(array $data)
    {
        $statement = "UPDATE categorie SET name = :name";
        
        return $this->db->prepare($statement, $data);
    }

    public function delete(int $id)
    {
        $statement = "DELETE FROM categorie WHERE id = $id";

        return $this->db->prepare($statement, array());
    }
}