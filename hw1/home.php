<?php
    require_once('db_op.php');
    require_once('autenticazione.php');

    if (checkAuth() == 0) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <head>
        <title>ReviewTaku - Home</title>
        <link rel="icon" href="img/logo.png"/>
        <script src="js/fetch_update.js" defer></script>
        <script src="js/fetchs.js" defer></script>
        <link rel="stylesheet" href="css/home.css"/>
        <link rel="stylesheet" href="css/base.css"/>
        <link rel="stylesheet" href="css/navbar.css"/>

    </head>
    <body>
        <nav class="navbar">
            <div><a href="#"><?php echo($_SESSION["hw1_ba_username"]);?></a></div>
            <div id="links">
                <div><a href="#">#WIP#</a></div> <!-- ricerca utente -->
                <div><a href="create_post.php">Crea un post</a></div>
                <div><a href="disconnessione.php">Sloggati</a></div>
            </div>
            <div id="lines">
                <div></div>
                <div></div>
                <div></div>
            </div>

        </nav>

        <div id="content">

        </div>
    </body>
</html>