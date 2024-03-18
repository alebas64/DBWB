<?php
    require_once("db_op.php");
    require_once("autenticazione.php");
    require_once('reg_login_func.php');

    if(checkAuth() != 0){
        header("Location: home.php");
        exit;
    }

    $array_check = array("username", "password");
    if(NOTempty($array_check)){
        $conn = db_connection();

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $search = filter_var($username, FILTER_VALIDATE_EMAIL) ? "email" : "nickname";

        //$query = "SELECT id, nickname, hash_pasw FROM user where $search = '$username';";
        $query = "SELECT nickname, hash_pasw FROM user where nickname = '$username';";
        $res = mysqli_query($conn,$query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res)>0){
            $utente = mysqli_fetch_assoc($res);
            if(password_verify($password,$utente["hash_pasw"])){
                $_SESSION["hw1_ba_username"] = $utente["nickname"];
                $_SESSION["hw1_ba_id"] = 420;

                header("Location: home.php");

                mysqli_free_result($res);
                mysqli_close($close);

                exit;
            }
            //password errata
        }
        //username non trovato (forse anche password per l'arwer errata)
    }

?>

<!doctype HTML>
<HTML>
    <head>
        <title>ReviewTaku - Login</title>
        <link rel="icon" href="img/logo.png"/>
        <link rel="stylesheet" href="css/base.css"/>
        <link rel="stylesheet" href="css/login_register.css"/>
        <script src="js/login.js" defer></script>
    </head>

    <body>
        <div id="main">
            <div><h1>ReviewTaku</h1></div>
            <form name="login" method="post">
                <div class="username">
                    <div><label><input type="text" name="username" placeholder="Username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label></div>
                    <div><span style="visibility:<?php echo(user());?>;">Username errato</span></div>
                </div>
                <div class="password">
                    <div><label><input type ="password" name="password" placeholder="Conferma password"/></label></div>
                    <div><span style="visibility:<?php echo(password());?>;">Password non valida</span></div>
                </div>
                <div class="invio">
                    <div><label><input type="submit" name="Invio" id="invio" disabled="false"/></label></div>
                </div>
                <div class="account">
                    <div><p>Non hai un account?  <a href="register.php">Registrati</a></p></div>
                </div>
            </form>
        </div>
    </body>
</HTML>