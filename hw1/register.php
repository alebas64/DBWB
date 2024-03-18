<?php
    require_once('db_op.php');
    require_once('autenticazione.php');
    require_once('reg_login_func.php');

    if (checkAuth() != 0) {
        header("Location: home.php");
        //printSession(); //solo per debug
        exit;
    }
    

    //$array_check = array("username", "password", "passwordC", "email", "sesso", "date");
    $array_check = array("username", "password", "passwordC", "email", "sesso");
    if(NOTempty($array_check)){
        $conn = db_connection();
        $username = mysqli_real_escape_string($conn,$_POST["username"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]);
        $passwordC = mysqli_real_escape_string($conn,$_POST["passwordC"]);
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $sex = $_POST["sesso"];
        $date = date("Y-M-D",strtotime(mysqli_real_escape_string($conn,$_POST["date"])));
        
        //$query = "select nickname,email from user where email= '$email'";

        $array_flag = array();
        

        $tmp = validateUsername($_POST["username"]);
        if(count($tmp)!=0){
            foreach($tmp as $item)
                $array_flag[] = $item;
        }

        $tmp = validatePassword($_POST["password"],$_POST["passwordC"]);
        if(count($tmp)!=0){
            foreach($tmp as $item)
                $array_flag[] = $item;
        }

        //verifica se ci sono errori/doppioni di mail
        $tmp = validateEmail($_POST["email"]);
        if(count($tmp)!=0){
            foreach($tmp as $item)
                $array_flag[] = $item;
        }

       // echo count($array_flag);
        if(count($array_flag) == 0){
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO user(nickname, nascita, hash_pasw, sesso, email) VALUE('$username','$date','$password','$sex','$email')";
            //$query = "INSERT INTO user(nickname, hash_pasw, sesso, email) VALUE('$username', '$password','$sex','$email')";
            if(mysqli_query($conn,$query)){
                $_SESSION["hw1_ba_username"] = $username;
                $_SESSION["hw1_ba_id"] = $utente["id"];
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            }else{
                $array_flag[] = "Errore di connessione al database";
                mysqli_close($conn);
                header("Location: register.php?dbError");
                exit;
            }
        }else{
            mysqli_close($conn);
            $errorLocationString="";
            $errorLocationString=$errorLocationString.$array_flag[0];
            for($i=1;$i<count($array_flag);$i=$i+1){
                $errorLocationString="&".$array_flag[$i].$errorLocationString;
            }
            header("Location: register.php?".$errorLocationString);
            exit;
        }
        
    }
?>

<!doctype HTML>
<HTML>
    <head>
        <title>ReviewTaku - Register</title>
        <link rel="icon" href="img/logo.png"/>
        <link rel="stylesheet" href="css/base.css"/>
        <link rel="stylesheet" href="css/login_register.css"/>
        <script src="js/register.js" defer></script>
    </head>

    <body>
        <div id="main">
            <div><h1>ReviewTaku</h1></div>
            <form name="registrazione" method="post" autocomplete="off">
                <div class="username">
                    <div><input type="text" name="username" placeholder="Username"/></div>
                    <div><span style="visibility:<?php echo(user());?>;">Username già in uso</span></div>
                </div>
                <div class="password">
                    <div><input type ="password" name="password" placeholder="Conferma password"/></div>
                    <div><span style="visibility:<?php echo(password());?>;">Password non valida</span></div>
                </div>
                <div class="passwordC">
                    <div><input type ="password" name="passwordC" placeholder="Conferma password"/></div>
                    <div><span style="visibility:<?php echo(passwordC());?>;">Le password non corrispondono</span></div>
                </div>
                <div class="email">
                    <div><input type="text" name="email" placeholder="Email"/></div>
                    <div><span style="visibility:<?php echo(email());?>;">Email non valida</span></div>
                </div>
                <div class="date">
                    <div><input type="date"/></div>
                    <div><span style="visibility:<?php echo(dateCheck());?>;">Età non valida</span></div>
                </div>
                <div class="sesso">
                    <div><p>Sesso</p></div>
                    <div class="sub">
                        <div class="item">
                            <div><input type="radio" name="sesso" value="u"></div>
                            <div><p>Uomo</p></div> 
                        </div>
                        <div class="item">
                            <div><input type="radio" name="sesso" value="d"></div>
                            <div><p>Donna</p></div>
                        </div>
                        <div class="item">
                            <div><input type="radio" name="sesso" value="n"></div>
                            <div><p>!(10101)</p></div>
                        </div>
                    </div>
                    <div><span style="visibility:<?php echo(sesso());?>;">Seleziona un sesso</span></div>
                </div>
                <div class="invio">
                    <div><input type="submit" name="Invio" id="invio" disabled/></div>
                </div>
                <div class="account">
                    <div><p>Hai un account?  <a href="login.php">Accedi</a></p></div>
                </div>
            </form>
        </div>
    </body>
</HTML>