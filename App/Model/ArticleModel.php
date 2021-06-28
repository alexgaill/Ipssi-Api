<?php
namespace App\Model;

use App\Entity\Article;
use Core\Database;

class ArticleModel {

    private $className = "App\Entity\Article";

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * return list of Articles
     *
     * @return Article[]
     */
    public function findAll() :array
    {
        $statement = "SELECT * FROM article";
        return $this->db->query($statement, $this->className);
    }

    /**
     * Return an Article
     *
     * @param int $id
     * @return Article
     */
    public function find(int $id) :Article
    {
        $statement = "SELECT * FROM article WHERE id = $id";
        return $this->db->query($statement, $this->className, true);
    }

    public function create(array $data)
    {
        $statement = "INSERT INTO article (title, content, categorie_id, user_id) 
            VALUES (:title, :content, :categorie_id, :user_id)";
        return $this->db->prepare($statement, $data);
    }

    public function update(array $data)
    {
        $statement = "UPDATE article SET
                        title = :title,
                        content = :content,
                        categorie_id = :categorie_id,
                        user_id = :user_id
                        ";
        
        return $this->db->prepare($statement, $data);
    }

    public function delete(int $id)
    {
        $statement = "DELETE FROM article WHERE id = $id";

        return $this->db->prepare($statement, array());
    }
}