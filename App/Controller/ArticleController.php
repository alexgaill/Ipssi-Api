<?php
namespace App\Controller;

use App\Model\ArticleModel;
use Core\Controller\DefaultController;
use OpenApi\Annotations as OA;

class ArticleController extends DefaultController{
    
    public function __construct()
    {
        $this->model = new ArticleModel;
    }

    /**
     * List all articles
     * @OA\Get(
     *      path="/article",
     *      summary="List all articles",
     *      @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          description="limit permettant la pagination",
     *          required=false,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="apikey",
     *          in="query",
     *          description="apikey permettant de valider l'application",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response = "200",
     *          description="List all articles",
     *          @OA\JsonContent(
     *              type="array",
     *              description="Article[]",
     *              @OA\Items(
     *                  ref="#/components/schemas/Article"
     *              ),
     *          ),
     *          @OA\XmlContent(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="apiKey missing",
     *          @OA\JsonContent(
     *              type="string",
     *              description="apikey manquante"
     *          )
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="internal server error",
     *          @OA\JsonContent(
     *              type="string",
     *              description="apikey manquante"
     *          )
     *      )
     * )
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
     * @OA\Get(
     *      path="/article/{id}",
     *      summary="return an article",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id de l'article à récupérer",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="apikey",
     *          in="query",
     *          description="apikey permettant de valider l'application",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response ="200",
     *          description="return an article",
     *          @OA\JsonContent(ref="#/components/schemas/Article")
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="apiKey missing",
     *          @OA\JsonContent(
     *              type="string",
     *              description="apikey manquante"
     *          )
     *      ),
     *      @OA\Response(
     *          response="500",
     *          description="internal server error",
     *          @OA\JsonContent(
     *              type="string",
     *              description="apikey manquante"
     *          )
     *      )
     * )
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
     * @OA\Post(
     *      path="/article/create",
     *      summary="Create article",
     *      @OA\Parameter(
     *          name="apikey",
     *          in="query",
     *          description="apikey permettant de valider l'application",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Article enregistré",
     *          @OA\JsonContent(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Article à enregistrer",
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="title",
     *                  type="string",
     *                  example="Nouvel article"
     *              ),
     *              @OA\Property(
     *                  property="content",
     *                  type="string",
     *                  example="Lorem ipsum dolor sit amet"
     *              ),
     *              @OA\Property(
     *                  property="categorie_id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="user_id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="picture",
     *                  type="integer",
     *                  example=null
     *              ),
     *          )
     *      )
     * )
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
     * @OA\Put(
     *      path="/article/{id}/update",
     *      summary="Update article",
     *      @OA\Parameter(
     *          name="apikey",
     *          in="query",
     *          description="apikey permettant de valider l'application",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id de l'article à mettre à jour",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Article enregistré",
     *          @OA\JsonContent(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Nouvelles données de l'article",
     *          required=true,
     *          request="Update article",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="title",
     *                  type="string",
     *                  example="Nouvel article"
     *              ),
     *              @OA\Property(
     *                  property="content",
     *                  type="string",
     *                  example="Lorem ipsum dolor sit amet"
     *              ),
     *              @OA\Property(
     *                  property="categorie_id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="user_id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="picture",
     *                  type="integer",
     *                  example=null
     *              ),
     *          )
     *      )
     * )
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
     * @OA\Delete(
     *      path="/article/{id}/delete",
     *      summary="Delete article",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="id de l'article à supprimer",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="apikey",
     *          in="query",
     *          description="apikey permettant de valider l'application",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Suppression validée",
     *          @OA\JsonContent(
     *              type="string",
     *              example="Article supprimé"
     *          )
     *      )
     * )
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