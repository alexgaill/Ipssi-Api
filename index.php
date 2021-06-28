<?php

use App\Controller\ArticleController;

require "vendor/autoload.php";


$controller = new ArticleController;
$articles = $controller->list();

// $article = $db->query("SELECT * FROM article WHERE id= 1");
// $article = $db->prepare(
//     "INSERT INTO article (title, content, categorie_id, user_id) 
//     VALUES (:title, :content, :categorie_id, :user_id)",
//     [
//         "title" => "article api",
//         "content" => "Lorem ipsum",
//         "categorie_id" => 2,
//         "user_id" => 1
//     ]
// );
// $article = $db->prepare(
//     "UPDATE article SET
//     picture = :picture
//     WHERE id= 89",
//     [
//         "picture" => null
//     ]
// );

// $article = $db->prepare("DELETE FROM article WHERE id=93");

// header("content-type: Application/json");
// header("cache-control: public, max-age=1000");
// echo json_encode($articles);