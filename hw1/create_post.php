<?php
    require_once('db_op.php');
    require_once('autenticazione.php');

    if (checkAuth() == 0) {
        header("Location: login.php");
        exit;
    }

    $conn = db_connection();
    if(!empty($_POST["recensione"]) && filter_var(mysqli_real_escape_string($conn,$_POST["id"]),FILTER_VALIDATE_INT)){
        
        $username = $_SESSION["hw1_ba_username"];
        $recensione = mysqli_real_escape_string($conn,$_POST["recensione"]);
        $anime_id =  mysqli_real_escape_string($conn,$_POST["id"]);
        $anime_pic = mysqli_real_escape_string($conn,$_POST["pic"]);
        $anime_title = mysqli_real_escape_string($conn,$_POST["title"]);

        $query="INSERT INTO post(cod_creatore,image_link,anime_id,anime_title,descr) value('$username', '$anime_pic', '$anime_id', '$anime_title', '$recensione')";
        if(mysqli_query($conn,$query)){
            mysqli_close($conn);
            header("Location: home.php");
            exit;
        }
        mysqli_close($conn);
        header("Location: home.php");
        exit;
    }
    mysqli_close($conn);
    

?>

<html>
    <head>
        <title>ReviewTaku - Create post</title>
        <link rel="icon" href="img/logo.png"/>
        <script src="js/search.js" defer></script>
        <script src="js/api_builder.js" defer></script>

        <link rel="stylesheet" href="css/create_post.css"/>
        <link rel="stylesheet" href="css/base.css"/>
        <link rel="stylesheet" href="css/navbar.css"/>
    </head>
    <body>
    <nav class="navbar">
            <div><a href="#"><?php echo($_SESSION["hw1_ba_username"]);?></a></div>
            <div id="links">
                <div><a href="home.php">Homepage</a></div>
            </div>
            <div id="lines">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
        <div id="main">
            <div name="research" id="research">
                <form id="search" method="GET">
                    <div class="radio">
                        <div><p>Seleziona metodo ricerca</p></div>
                        <div class="sub">
                            <div class="item">
                                <div><input type="radio" class="radio" name="by" value="id"/></div>
                                <div><p>Identificativo</p></div>
                            </div>
                            <div class="item">
                                <div><input type="radio" class="radio" name="by" value="titolo"/></div>
                                <div><p>Titolo</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="sub">
                        <div class="item">
                            <div><input type="checkbox" id="nsfw" name="nsfw" value="nsfwON"/></div>
                            <div><p>NSFW</p></div>
                        </div>
                    </div>
                    <div><input type="text" id="searchBar" placeholder="Seleziona un parametro di ricerca" disabled/></div>
                    <div><input type="button" id="clear" value="Pulisci"/></div>
                    <div><input type="button" id="searchButton" value="Ricerca"/></div>
                    
                    
                    
                </form>
            </div>
            
            <div name="content" id="content">
                
            </div>
            <div name="selected" id="hidden">
                
                <form method="post" name="formRecensione">
                    <div>
                        <input type="button" id="choseAnother" value="Seleziona un altro anime"/>
                    </div>

                    <input type="hidden" name="id"/>
                    <input type="hidden" name="pic"/>
                    <input type="hidden" name="title"/>
                    
                    <div>
                        <textarea id="textRecensione" name="recensione" placeholder="scrivi la tua recensione"></textarea>
                    </div>
                    
                    <div>
                        <input type="submit" id="sendButton" name="submit" value="Invia recensione"/>
                    </div>
                    
                </form>
            </div>
        </div>
    </body>
</html>