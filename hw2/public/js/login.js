function verifyUsername(){
    const campo = document.querySelector('.username input');

    if(!verifyCharactersU(campo.value)){
        registerLog.username = verifyEmail();
    }else{
        registerLog.username = true;
    }
    verifyForm();
}

function verifyEmail(){
    const campo = document.querySelector('.username input');

    if(!verifyCharactersE(campo.value)){
        registerLog.email = false;
    }else{
        registerLog.email = true;
    }
    verifyForm();
}

function verifyPassword(){
    const campo = document.querySelector('.password input');

    if(!verifyCharactersP(campo.value)){
        registerLog.password = false;
    }else{
        registerLog.password = true;
    }
    verifyForm();
}

function verifyPasswordC(){
    const campo = document.querySelector('.passwordC input');

    if(!verifyCharactersP(campo.value)){
        registerLog.passwordC = false;
    }else{
        registerLog.passwordC = true;
    }
    verifyForm();
}

function verifyDate(){
    console.log("date");
    const campo = document.querySelector('.date input');
    if(campo.value === ''){
        registerLog.date = false;
    }else{
        registerLog.date = true;
    }
    verifyForm();
}

function verifySex(){
    const campo = document.querySelectorAll(".sesso input");
    
    if(!verifyChoosedSex(campo)){
        registerLog.sex = false;
    }else{
        registerLog.sex = true;
    }
    verifyForm();
}

function verifyForm(){
    //document.getElementById("invio").disabled = Object.keys(registerLog).lenght!==6 || Object.values(registerLog).includes(false);
    document.getElementById("invio").disabled = Object.values(registerLog).includes(false);

    /*
    let tmp = Object.keys(registerLog);
    document.getElementById("invio").disabled = tmp.lenght!==6 || Object.values(registerLog).includes(false);
    */
}

//funzione per verificare validità dei caratteri di username
//ritorna falso se la stringa non è ok
function verifyCharactersU(stringa){
    return /^[a-zA-Z0-9_]{1,15}$/.test(stringa);
}

//funzione per verificare validità dei caratteri di password e passwordC
//ritorna falso se la stringa non è ok
function verifyCharactersP(stringa){
    return /^[a-zA-Z0-9_]{8,64}$/.test(stringa);
}

//funzione per verificare validità dei caratteri di email
//ritorna falso se la stringa non è ok
function verifyCharactersE(stringa){
    //stringa = ;
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        .test(String(stringa).toLowerCase());
}

//funzione per verificare se è stato selezionato una opzione
//ritorna falso se non è stato selezionato nulla
function verifyChoosedSex(nodeList){
    return nodeList[0].checked||nodeList[1].checked||nodeList[2].checked;
}

const registerLog = {'username' : false,
                     'password' : false,};
document.querySelector('.username input').addEventListener('blur', verifyUsername);
document.querySelector('.password input').addEventListener('blur', verifyPassword);


/*
if (document.querySelector('.error') !== null) {
    checkUsername(); checkPassword(); checkConfirmPassword(); checkEmail();
    document.querySelector('.name input').dispatchEvent(new Event('blur'));
    document.querySelector('.surname input').dispatchEvent(new Event('blur'));
}
*/