<?php
    require_once('db_op.php');
    require_once('autenticazione.php');

    if (checkAuth() == 0) {
        header("Location: login.php");
        exit;
    }

    //$conn = db_connection();
    //$userid = mysqli_real_escape_string($conn,$userid);

?>

<html>
    <head>
        
        <link rel="stylesheet" href="css/home.css"/>
        <link rel="stylesheet" href="css/base.css"/>
    </head>
    <body>
        <a href="disconnessione.php">Sloggati</a>
        <a href="create_post.php">Crea un post</a>

        <div id="content">

            <div class="post">
                <section>
                    <div class="animePIC">
                        <img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx11665-nfbt94cwKySE.png">
                    </div>
                    <div class="userContent">
                        <div><p class="animeTITLE">titolo anime</p></div>
                        <div><p class="description">dadsafadsvegrwvsdWe</p></div>
                    </div>
                </section>
                
                <section>
                    <div>
                        <div><p class="creatorTag">sasistegi</p></div>
                        <div><p class="creationDate">2022-05-26 16:06:32</p></div> 
                    </div>
                    <div class="nLikes_comments">
                        <div class="sub">
                            <div><img class="likes-comments" src="img/nolike.png"></div>
                            <div><p>0</p></div>
                        </div>
                        <div class="sub">
                            <div><img class="likes-comments" src="img/comments.png"></div>
                            <div><p>1</p></div>
                        </div>
                    </div>
                </section>
            </div>

           
            <div class="post">
                <section>
                    <div class="animePIC">
                        <img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx11665-nfbt94cwKySE.png">
                    </div>
                    <div class="userContent">
                        <div><p class="animeTITLE">titolo anime</p></div>
                        <div><p class="description">dadsafadsvegrwvsdWe</p></div>
                    </div>
                </section>
                
                <section>
                    <div>
                        <div><p class="creatorTag">sasistegi</p></div>
                        <div><p class="creationDate">2022-05-26 16:06:32</p></div> 
                    </div>
                    <div class="nLikes_comments">
                        <div class="sub">
                            <div><img class="likes-comments" src="img/nolike.png"></div>
                            <div><p>0</p></div>
                        </div>
                        <div class="sub">
                            <div><img class="likes-comments" src="img/comments.png"></div>
                            <div><p>1</p></div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="post">
                <section>
                    <div class="animePIC">
                        <img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/bx11665-nfbt94cwKySE.png">
                    </div>
                    <div class="userContent">
                        <div><p class="animeTITLE">titolo anime</p></div>
                        <div><p class="description">dadsafadsvegrwvsdWe</p></div>
                    </div>
                </section>
                
                <section>
                    <div>
                        <div><p class="creatorTag">sasistegi</p></div>
                        <div><p class="creationDate">2022-05-26 16:06:32</p></div> 
                    </div>
                    <div class="nLikes_comments">
                        <div class="sub">
                            <div><img class="likes-comments" src="img/nolike.png"></div>
                            <div><p>0</p></div>
                        </div>
                        <div class="sub">
                            <div><img class="likes-comments" src="img/comments.png"></div>
                            <div><p>1</p></div>
                        </div>
                    </div>
                </section>
            </div>
    </body>
</html>