<?php
    function user(){
        if(isset($_GET["userCar"]) || isset($_GET["userLen"]) || isset($_GET["userUsed"]))
            return "show";
        return "hidden";
    }
    function password(){
        if(isset($_GET["pswLenLow"]) || isset($_GET["pswLenHigh"]))
            return "show";
        return "hidden";

    }
    function passwordC(){
        if(isset($_GET["pswMM"]))
            return "show";
        return "hidden";

    }
    function email(){
        if(isset($_GET["emailINVL"]) || isset($_GET["emailUsed"]))
            return "show";
        return "hidden";

    }
    function dateCheck(){ //wip
        //if(isset($_GET[""]))
        //    return "show";
        return "hidden";

    }
    function sesso(){ //wip
        //if(isset($_GET[""]))
        //    return "show";
        return "hidden";

    }
?>