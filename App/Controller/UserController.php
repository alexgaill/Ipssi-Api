<?php
namespace App\Controller;

use App\Model\UserModel;
use Core\Controller\DefaultController;
use DateTime;
use Firebase\JWT\JWT;

class UserController extends DefaultController{
    
    public function __construct()
    {
        $this->model = new UserModel;
    }

    /**
     * List all the users
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
                "update" => SERVER . "user/". $value->id ."/update",
                "delete" => SERVER . "user/". $value->id ."/delete"
            ];
            $data[] = $value;
        }
        $this->jsonResponse($data);
    }

    // /**
    //  * return an user
    //  *
    //  * @param integer $id
    //  * @return void
    //  */
    // public function single (int $id)
    // {
    //     $data = $this->model->find($id);
    //     $data->links = [
    //         "categorie" => SERVER . "categorie/". $data->categorie_id,
    //         "user" => SERVER . "user/". $data->user_id,
    //         "update" => SERVER . "user/". $data->id ."/update",
    //         "delete" => SERVER . "user/". $data->id ."/delete"
    //     ];
    //     $this->jsonResponse($data);
    // }

    /**
     * Save user in DB
     *
     * @param array $data
     * @return void
     */
    public function create (array $data) 
    {
        $save = $this->model->create($data);
        if ($save === true) {
            $this->saveJsonResponse("user bien enregistré");
        } else {
            $this->internalErrorResponse("L'user n'a pas pu être enregistré. Veuillez réessayer");
        }
    }

    /**
     * Update user in Db
     *
     * @param array $data
     * @param int $id
     * @return void
     */
    public function update (int $id, array $data) 
    {
        $update = $this->model->update($id, $data);
        if ($update === true) {
            $this->saveJsonResponse("user bien mis à jour");
        } else {
            $this->internalErrorResponse("L'user n'a pas pu être mis à jour. Veuillez réessayer");
        }

    }

    /**
     * Delete user in Db
     *
     * @param string $id
     * @return void
     */
    public function delete (string $id)
    {
        $delete = $this->model->delete($id);
        if ($delete === true) {
            $this->saveJsonResponse("user bien été supprimé");
        } else {
            $this->internalErrorResponse("L'user n'a pas pu être supprimé. Veuillez réessayer");
        }
    }

     /**
     * return an user
     *
     * @param integer $id
     * @return void
     */
    public function login (array $currentUser)
    {
        $user = $this->model->getUserByEmail($currentUser["email"]);
        if (password_verify($currentUser["password"], $user->getPassword())) {
            $date = new \DateTime();
            $date->add(new \DateInterval('P1D'));
            $ts = $date->getTimestamp();
            $key = "toto";
            $payload = [
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "pseudo" => $user->getPseudo(),
                "roles" => $user->getRole(),
                "exp" => $ts
            ];
            $jwt = JWT::encode($payload, $key);
            $this->jsonResponse($jwt);
        } else {
            $this->unauthorizedResponse("Erreur identifiants");
        }
    }
}