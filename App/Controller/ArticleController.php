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
        $this->jsonResponse($this->model->findAll());
    }

    public function single ($id)
    {
        $this->jsonResponse($this->model->find($id));
    }

    public function create ($data) 
    {
        $this->jsonResponse($this->model->create($data));

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