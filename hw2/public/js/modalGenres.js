let modal = document.getElementById("modal");
let span = document.getElementById("close");
let modal_genres = document.getElementById("modal-genres");

document.getElementById("genere").addEventListener("click",modalShow);
span.addEventListener("click",modalClose);
window.addEventListener("click",modalCloseW);

function modalClose() {
    console.log("modalClose");
    modal.style.display = "none";
}

function removePostModal(){
    modal_genres.textContent="";
    modal_comment.textContent="";
}

function modalCloseW(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function modalShow(){
    modal.style.display = "block";
}

