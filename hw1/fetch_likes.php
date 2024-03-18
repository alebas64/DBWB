<?php
    require_once("autenticazione.php");
    require_once("db_op.php");
    if(checkAuth() == 0){
        header("Location: login.php");
        exit;
    }
    if(!isset($_GET["name"])){
        header("Location: home.php");
        exit;
    }
    //if($_POST[""])

    $conn = db_connection();


    if($conn){
        //$query = "SELECT *, UNIX_TIMESTAMP(createdAt) AS UNIX_TIME FROM post ORDER BY UNIX_TIME DESC LIMIT 10;";
/*
        $query = "SELECT cod_creatore,image_link,descr,createdAt,no_likes,no_comments,cod_utente, UNIX_TIMESTAMP(createdAt) AS UNIX_TIME
        FROM post p left join likes_posts lp on p.id = lp.cod_post
        ORDER BY UNIX_TIME DESC LIMIT 10;";

*/
        $id_post = mysqli_real_escape_string($conn,$_GET["name"]);
        $query = "SELECT * from likes_posts WHERE cod_utente=".'"'.$_SESSION['hw1_ba_username'].'"'."AND cod_post=".'"'.$id_post.'"'."";
        $res = mysqli_query($conn,$query);
        if(mysqli_num_rows($res) == 0){
            $query = "INSERT INTO likes_posts (cod_utente, cod_post) VALUES (".'"'.$_SESSION['hw1_ba_username'].'"'.", ".'"'.$id_post.'"'.")";
            $return = array("operation" => "insert");
        }else{
            $query = "DELETE FROM likes_posts WHERE cod_utente=".'"'.$_SESSION['hw1_ba_username'].'"'."AND cod_post=".'"'.$id_post.'"'."";
            $return = array("operation" => "delete");
        }
        $res = mysqli_query($conn,$query);

        mysqli_close($conn);

        echo json_encode($return);

        exit;
    }

    //inserire anche la parte per richiedere post successivi
    //in caso di nessun post disponibile inviare una foto di una volpe
?>