<?php
namespace App\Controller;

use App\Model\ArticleModel;
use Core\Controller\DefaultController;

class ArticleController extends DefaultController{
    
    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    /**
     * List all the articles
     *
     * @return void
     */
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

    /**
     * return an article
     *
     * @param integer $id
     * @return void
     */
    public function single (int $id)
    {
        $data = $this->model->find($id);
        $data->links = [
            "categorie" => SERVER . "categorie/". $data->categorie_id,
            "user" => SERVER . "user/". $data->user_id,
            "update" => SERVER . "article/". $data->id ."/update",
            "delete" => SERVER . "article/". $data->id ."/delete"
        ];
        $this->jsonResponse($data);
    }

    /**
     * Save article in DB
     *
     * @param array $data
     * @return void
     */
    public function create (array $data) 
    {
        $save = $this->model->create($data);
        if ($save === true) {
            $this->saveJsonResponse("Article bien enregistré");
        } else {
            $this->internalErrorResponse("L'article n'a pas pu être enregistré. Veuillez réessayer");
        }
    }

    /**
     * Update article in Db
     *
     * @param array $data
     * @param int $id
     * @return void
     */
    public function update (int $id, array $data) 
    {
        $update = $this->model->update($id, $data);
        if ($update === true) {
            $this->saveJsonResponse("Article bien mis à jour");
        } else {
            $this->internalErrorResponse("L'article n'a pas pu être mis à jour. Veuillez réessayer");
        }

    }

    /**
     * Delete article in Db
     *
     * @param string $id
     * @return void
     */
    public function delete (string $id)
    {
        $delete = $this->model->delete($id);
        if ($delete === true) {
            $this->saveJsonResponse("Article bien été supprimé");
        } else {
            $this->internalErrorResponse("L'article n'a pas pu être supprimé. Veuillez réessayer");
        }
    }
}