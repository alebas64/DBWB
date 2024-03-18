postpost(PROFILE_ROUTE+"/feed/"+USER);
/*
fetch(PROFILE_ROUTE+"/getUser/"+USER).then(onResponse).then(userInfo);

let test1111;
function userInfo(result){
    test1111=result;
    console.log(result);
    if(result.result==="success"){
        document.getElementsByClassName("username")[0].lastChild.textContent=result.data[0].username;
        document.getElementsByClassName("nascita")[0].lastChild.textContent=result.data[0].nascita;
        document.getElementsByClassName("sesso")[0].lastChild.textContent=getsex(result.data[0].sesso);
    }
    
}*/

function getsex(lecter){
    if(lecter==="u")
        return "Uomo";
    if(lecter==="d")
        return "Donna";
    return "Non binario";
}