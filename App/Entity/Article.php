<?php
namespace App\Entity;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(title="Article")
 */
class Article {

    /**
     * @OA\Property(
     *      type="integer",
     *      nullable=false,
     * )
     * @var int
     */
    public $id;
    
    /**
     * @OA\Property(
     *      type="string",
     *      nullable=false
     * )
     * @var string
     */
    public $title;
    
    /**
     * @OA\Property(
     *      type="string",
     *      nullable=false
     * )
     * @var string
     */
    public $content;

    /**
     * @OA\Property(
     *      type="integer",
     *      nullable=false
     * )
     * @var int
     */
    public $categorie_id;

    /**
     * @OA\Property(
     *      type="integer",
     *      nullable=false
     * )
     * @var int
     */
    public $user_id;

    /**
     * @OA\Property(
     *      type="string",
     *      nullable=true
     * )
     * @var string
     */
    public $picture;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of article
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of article
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of categorie_id
     */
    public function getCategorieId()
    {
        return $this->categorie_id;
    }

    /**
     * Set the value of categorie_id
     */
    public function setCategorieId($categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */
    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}