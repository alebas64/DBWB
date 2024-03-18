<?php
    require_once("data.php");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, API_FOXES);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);
    echo $res;
?>