<?php
namespace App\Model;

use Core\Database;
use App\Entity\User;

class UserModel {

    private $className = "App\Entity\User";

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * return list of users
     *
     * @return user[]
     */
    public function findAll() :array
    {
        $statement = "SELECT * FROM user";
        return $this->db->query($statement, $this->className);
    }

    /**
     * Return user
     *
     * @param int $id
     * @return user
     */
    public function find(int $id) :user
    {
        $statement = "SELECT * FROM user WHERE id = $id";
        return $this->db->query($statement, $this->className, true);
    }

    public function create(array $data)
    {
        $statement = "INSERT INTO user (name) 
            VALUES (:name)";
        return $this->db->prepare($statement, $data);
    }

    public function update(int $id, array $data)
    {
        $statement = "UPDATE user SET name = :name WHERE id = $id";
        
        return $this->db->prepare($statement, $data);
    }

    public function delete(int $id)
    {
        $statement = "DELETE FROM user WHERE id = $id";

        return $this->db->prepare($statement, array());
    }

    public function getUserByEmail($email)
    {
        $statement = "SELECT * FROM user WHERE email = '$email'";
        return $this->db->query($statement, $this->className, true);
    }
}