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
/*
        $query = "SELECT p.id,p.anime_title,p.cod_creatore,p.image_link,p.descr,p.createdAt,p.no_likes,p.no_comments,lp.cod_utente, UNIX_TIMESTAMP(p.createdAt) AS 
        UNIX_TIME FROM (post p left join likes_posts lp on (p.id = lp.cod_post AND ".'"'.$_SESSION['hw1_ba_username'].'"'." = p.cod_creatore)) ORDER BY UNIX_TIME DESC LIMIT 10;";*/
        $query = "SELECT p.id,p.anime_title,p.cod_creatore,p.image_link,p.descr,p.createdAt,p.no_likes,p.no_comments, lp.cod_utente,
        UNIX_TIMESTAMP(p.createdAt) AS UNIX_TIME 
        from likes_posts lp right join post p on (lp.cod_utente = ".'"'.$_SESSION['hw1_ba_username'].'"'." and p.id = lp.cod_post)
        ORDER BY UNIX_TIME DESC LIMIT 10;";
        $res = mysqli_query($conn,$query);
        $json_prot = array();
        //$return = mysqli_fetch_assoc($res);
        while($result = mysqli_fetch_assoc($res)){
            $json_prot[] = array(
                "user" => $result["cod_creatore"],
                "descrizione" => $result["descr"],
                "image" => $result["image_link"],
                "likes" => $result["no_likes"],
                "comments" => $result["no_comments"],
                "createdOn" => $result["createdAt"],
                "timestamp" => $result["UNIX_TIME"],
                "liked" => $result["cod_utente"] == NULL ? "no" : "si",
                "title" => $result["anime_title"],
                "name" => $result["id"]
                //nel database mi salvo l'id del manga o serie,
                //da quello posso ottenere tutto quello che mi interessa (immagine, titolo, trama ecc)
                //è tutto molto più pratico e posso riusare parti dei codici vecchi
                //"image" => base64_encode($return["image"])
            );
        
        }

        mysqli_close($conn);

        echo json_encode($json_prot);

        exit;
    }

    //inserire anche la parte per richiedere post successivi
    //in caso di nessun post disponibile inviare una foto di una volpe
?>