let modal = document.getElementById("modal");
let span = document.getElementById("close");
let modal_post = document.getElementById("modal-post");
let modal_comment = document.getElementById("comment-section");
let like_or,comment_or;
document.getElementById("input_comment").children[1].addEventListener("click",sendComment);
function modalClose() {
    console.log("modalClose");
    modal_LikeCommentUpdate();
    removePostModal();
    modal.style.display = "none";
}

function removePostModal(){
    modal_post.textContent="";
    modal_comment.textContent="";
}

function modalCloseW(event) {
    console.log("modalCloseW");
    if (event.target == modal) {
        modal_LikeCommentUpdate();
        removePostModal();
        modal.style.display = "none";
    }
}

function increaseComment(){
    const mod = modal.children[0].children[1].children[0].children[1]
    .children[1].children[0].children[1].children[1];
    mod.textContent = parseInt(mod.textContent) + 1;
}

function sendComment(){
    let testo = document.getElementById("input_comment").children[0].value;
    document.getElementById("input_comment").children[0].value="";
    if(testo.length==0)
        return;
    increaseComment();
    const postCOD = modal.children[0].children[1].children[0].children[1].children[1].children[0].children[0].getAttribute("name");
    fetch(PROFILE_ROUTE+"/sendComment/"+postCOD+"/"+testo).then(onResponse).then(insertComments);
}

function modalShow(){
    modal.style.display = "block";
}

function modal_LikeCommentUpdate(){
    const mod = modal.children[0].children[1].children[0].children[1].children[1].children[0];

    if(like_or.children[1].textContent != mod.children[0].children[1].textContent){
        like_or.children[1].textContent = mod.children[0].children[1].textContent;
        like_or.children[0].src = mod.children[0].children[0].src;
    }

    if(comment_or.textContent != mod.children[1].children[1].textContent){
        comment_or.textContent = mod.children[1].children[1].textContent;
    }

}

span.addEventListener("click",modalClose);
window.addEventListener("click",modalCloseW);