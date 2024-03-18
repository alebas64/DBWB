
let lines = document.getElementById("lines");
let links = document.getElementById("links_lines");
let show = false;
lines.addEventListener("click",linkShow);

window.addEventListener('resize', reportWindowSize);

function linkShow(){
    if(show){
        links.style.display = "none";
        show=false;
    }else{
        links.style.display = "block";
        show=true;
    }
    
}

function reportWindowSize() {
    if(window.innerWidth>730){
        links.style.display = "none";
        show=false;
    }
}