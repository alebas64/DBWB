postpost(PROFILE_ROUTE+"/feed");

document.getElementById("submit").addEventListener("click",function(event){
    event.preventDefault();
    let formdata = new FormData();
        formdata.append("_token",TOKEN);
        formdata.append("username",document.getElementById("usernameC").value);
        formdata.append("password",document.getElementById("passwordC").value);
        formdata.append("passwordC",document.getElementById("passwordCC").value)
        formdata.append("email",document.getElementById("emailC").value);
        for (var value of formdata.values()) {
            console.log(value); 
        }
    //console.log(formdata);
    let requestOptions = {
        method : "POST",
        body : formdata
    };
    fetch(PROFILE_ROUTE+"/change",requestOptions).then(onResponse).then(dataChange);
});

function dataChange(json){
    console.log(json);
    if(json.username === "success"){
        document.getElementById("username").textContent=document.getElementById("usernameC").value;
        document.getElementById("usernameC").value="";
    }else{
        document.getElementById("usernameE").textContent=json.username;
    }
    if(json.email === "success"){
        document.getElementById("email").textContent=document.getElementById("emailC").value;
        document.getElementById("emailC").value="";
    }else{
        document.getElementById("emailE").textContent=json.email;
    }
    if(json.password === "success"){
        document.getElementById("password").value="";
        document.getElementById("passwordC").value="";
    }else{
        document.getElementById("passwordE").textContent=json.password;
    }
}