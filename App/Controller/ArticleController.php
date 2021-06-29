<?php
namespace App\Controller;

use App\Model\ArticleModel;
use Core\Controller\DefaultController;

class ArticleController extends DefaultController{
    
    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    public function list ()
    {
        $data = array();
        foreach ($this->model->findAll() as $value) {
            $value->links = [
                "categorie" => SERVER . "categorie/". $value->categorie_id,
                "user" => SERVER . "user/". $value->user_id,
                "update" => SERVER . "article/". $value->id ."/update",
                "delete" => SERVER . "article/". $value->id ."/delete"
            ];
            $data[] = $value;
        }
        $this->jsonResponse($data);
    }

    public function single (int $id)
    {
            $this->jsonResponse($this->model->find($id));
    }

    public function create ($data) 
    {
        $save = $this->model->create($data);
        if ($save === true) {
            $this->saveJsonResponse("Article bien enregistré");
        } else {
            $this->BadRequestJsonResponse($save);
        }

    }

    public function update ($data) 
    {
        $this->jsonResponse($this->model->update($data));

    }

    public function delete (string $id)
    {
        $this->jsonResponse($this->model->delete($id));
    }
}