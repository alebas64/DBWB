function change_likes(event){
    console.log("Cambio like wip");
    let name = event.currentTarget.getAttribute("name");
    a = event.currentTarget;
    console.log(name);
    fetch(HOME_ROUTE+"/likes/"+name).then(onResponse).then(likeUpdate);

    //fetch(HOME_ROUTE+"/likes/"+"'<?php echo(session('user_id')) ?>'"+"/"+name).then(onResponse).then(likeUpdate);
}

function onResponse(response){
    //console.log(response.text());
    return response.json();
}

function likeUpdate(json){
    console.log(json);
    if(json.operation=="insert"){
        a.children[1].textContent=parseInt(a.children[1].textContent)+1;
        a.children[0].src = "img/like.png";
    }else{
        a.children[1].textContent=parseInt(a.children[1].textContent)-1;
        a.children[0].src = "img/nolike.png";
    }
}

function show_comments(event){
    let post = event.currentTarget;
    post = post.parentElement.parentElement.parentElement.parentElement;
    console.log(post);
    const tmp = post.cloneNode(true);
    tmp.children[1].children[1].children[0].children[0].addEventListener("click",change_likes);
    like_or = post.children[1].children[1].children[0].children[0];
    comment_or = post.children[1].children[1].children[0].children[1].children[1];
    modal_post.appendChild(tmp);
    modalShow();
    fetch(HOME_ROUTE+"/comments/"+like_or.getAttribute("name")).then(onResponse).then(insertComments);
    console.log("Comments show wip");
}

let aaaa;
function insertComments(response){
    console.log(response);
    aaaa = response;
    //modal.children[0].children[2].children[0].textContent="";
    if(response.length === undefined)
        modal_comment.insertBefore(buildComment(response),modal_comment.firstChild);
    else
        for(let i=0;i<response.length;i++){
            console.log("a");
            //modal.children[0].children[2].children[0].appendChild(
            modal_comment.insertBefore(buildComment(response.data[i]),modal_comment.firstChild);
        }
}

function buildComment(resource){
    let picciriddu = document.createElement("div");
    picciriddu.setAttribute("class","comment");
    picciriddu.appendChild(document.createElement("p"));
    let pointer;
    pointer = picciriddu.lastChild;
    pointer.setAttribute("class","creatore");
    pointer.textContent=resource["autore"];

    picciriddu.appendChild(document.createElement("p"));
    pointer = picciriddu.lastChild;
    pointer.setAttribute("class","testo_commento");
    pointer.textContent=resource["testo"];

    picciriddu.appendChild(document.createElement("p"));
    pointer = picciriddu.lastChild;
    pointer.setAttribute("class","time");
    pointer.textContent=resource["createdAt"];

    return picciriddu;
}