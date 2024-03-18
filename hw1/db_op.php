<?php
    require('db_data.php');

    function printSession(){ //debug purpose
        echo(
            "<p>Username ".$_SESSION["hw1_ba_username"]."</p><p>Id ".$_SESSION["hw1_ba_id"]."</p>"
        );
    }

    function db_connection(){
        //return mysqli_connect("$host","$user","$pass","$db") 
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB) 
        or die("error: ".mysqli_connect_error());
        return $connection;
    }
    function db_query($conn, $query){
        return mysqli_query($conn,$query);
    }
    //ritorna true se tutti i campi hanno un valore impostato
    function NOTempty($array){
        foreach($array as $item){
            if(empty($_POST[$item]) === true){
                return false;
            }
        }
        return true;
    }
    //ritorna true se il campo soddisfa le specifiche
    function validateUsername($username){
/*
        $flags = array();
        if(!preg_match('/^[a-zA-Z0-9_]$/',$username))
            $flags[] = "userCar";
*/
        if(strlen($username)>=20)
            $flags[] = "userLen";
            
        $conn = db_connection();
        $query = "select nickname from user where nickname= '$username'";
        $res = db_query($conn,$query);

        if(mysqli_num_rows($res)>0){
            $flags[] = "userUsed";
        }
        mysqli_close($conn);
        return $flags;
    }
    function validateEmail($email){
        $flags = array();
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $flags[] = "emailINVL";
        $conn = db_connection();
        $query = "select email from user where email= '$email'";
        $res = db_query($conn,$query);
        if(mysqli_num_rows($res) > 0){
            $flags[] = "emailUsed";
        }
        mysqli_close($conn);
        return $flags;
    }
    function validatePassword($password,$passwordC){
        $flags = array();
        if(strlen($password)<8)
            $flags[] = "pswLenLow";
        if(strlen($password)>32)
            $flags[] = "pswLenHigh";
        if($password != $passwordC)
            $flags[] = "pswMM";
        return $flags;
    }
    /*
    function validateDate($date){
        $flags = array();
        if(!$date){
            $flags[]="Data di nascita non valida";
        }else{
            //if($time - $date < )
        }
        return $flags;
    }
    */
    function hash_check($password,$utente){
        return password_verify($password,$utente["hash_pasw"]);
    }
?>