<?php
namespace App\Controller;

use App\Model\CategorieModel;
use Core\Controller\DefaultController;

class CategorieController extends DefaultController{
    
    public function __construct()
    {
        $this->model = new CategorieModel;
    }

    public function list ()
    {
        $data = array();
        foreach ($this->model->findAll() as $value) {
            $value->links = [
                "update" => SERVER . "categorie/". $value->id ."/update",
                "delete" => SERVER . "categorie/". $value->id ."/delete"
            ];
            $data[] = $value;
        }
        $this->jsonResponse($data);
    }

    public function single ($id)
    {
        $data = $this->model->find($id);
        $data->links = [
            "update" => SERVER . "categorie/". $data->id ."/update",
            "delete" => SERVER . "categorie/". $data->id ."/delete"
        ];
        $this->jsonResponse($data);
    }

    public function create ($data) 
    {
        $save = $this->model->create($data);
        if ($save === true) {
            $this->saveJsonResponse("Catégorie bien enregistré");
        } else {
            $this->internalErrorResponse("La catégorie n'a pas pu être enregistrée. Veuillez réessayer");
        }
    }

    public function update (int $id, array $data) 
    {
        $update = $this->model->update($data);
        if ($update === true) {
            $this->saveJsonResponse("Catégorie bien mis à jour");
        } else {
            $this->internalErrorResponse("La catégorie n'a pas pu être mise à jour. Veuillez réessayer");
        }
    }

    public function delete (string $id)
    {
        $delete = $this->model->delete($id);
        if ($delete === true) {
            $this->saveJsonResponse("Catégorie bien été supprimé");
        } else {
            $this->internalErrorResponse("La catégorie n'a pas pu être supprimée. Veuillez réessayer");
        }
    }
}