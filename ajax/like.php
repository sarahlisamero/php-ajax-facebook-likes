<?php
    require_once("../bootstrap.php");
    if( !empty($_POST) ) {
        $postId = $_POST['id'];
        $userId = 1; //dit zou gelijk moeten zijn aan de session wnr het niet hard coded is

        $l = new Like();
        $l->setPostId($postId);
        $l->setUserId($userId);
        $l->save();

        $p = new Post();
        $p-> id=$postId;
        $likes = $p->getLikes();
        /*var_dump($likes);
        die();
        1) requests debuggen in network tab in devtools, bij response*/

        $result = [
            "status" => "success",
            "message" => "Like was saved",
            "likes" => $likes
        ];

        echo json_encode($result); //zodat je eraan kan in frontend -> omzetten naar js stukje

    }