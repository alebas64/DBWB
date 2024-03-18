function change_likes(event){
    console.log("Cambio like wip");
    let name = event.currentTarget.getAttribute("name");
    a = event.currentTarget;
    console.log(name);
    fetch("fetch_likes.php?name="+name).then(onResponse).then(likeUpdate);
}

function onResponse(response){
    console.log(response.text());
    return response.json();
}

function likeUpdate(json){
    console.log(json);
    if(json.operation=="insert"){
        a.children[0].children[1].textContent=parseInt(a.children[0].children[1].textContent)+1;
        a.children[0].children[0].src = "img/like.png";
    }else{
        a.children[0].children[1].textContent=parseInt(a.children[0].children[1].textContent)-1;
        a.children[0].children[0].src = "img/nolike.png";
    }
}

function show_comments(){
    console.log("Comments show wip");
}