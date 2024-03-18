<?php
session_start();
function checkAuth() {
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        
        if(isset($_SESSION['hw1_ba_id'])) {
            return $_SESSION['hw1_ba_id'];
        } else 
            return 0;
    }

?>