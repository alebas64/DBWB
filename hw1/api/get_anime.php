<?php

    require_once("data.php");
    require_once("../autenticazione.php");

    if(checkAuth() == 0){
        header("Location: login.php");
        exit;
    }    

    switch($_GET["by"]){
        case "id":
            byID();
            break;
        
        case "titolo":
            byTITLE();
            break;

        default:
            break;
    }

    function byID(){
        $url_request = API_ANIME."?";
        $url_request .= "anilist_id=".(filter_var($_GET["title"],FILTER_VALIDATE_INT)? $_GET["title"] : "0");
        $curl=curl_init();
        curl_setopt_array($curl,array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url_request
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        echo($result);
    }

    function byTITLE(){
        $url_request = API_ANIME."?";
        $url_request.="title=".$_GET["title"];
        $url_request.= isset($_GET["nsfw"]) ? "&nsfw=".$_GET["nsfw"] : "&nsfw=false";

        $curl = curl_init();
        curl_setopt_array($curl,array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url_request
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        echo($result);
    }

?>