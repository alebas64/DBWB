//let last_post = 0;
let numPages = 0;
let page = 1;
//let last_search="";
//let last_search_type="";
//let checkboxValue;
let researchtext;
let sfw;
/*
let current_selection = {
    anime_id : 0,
    anime_title: "",
    anime_pic: "",
    recensione : ""
};
*/
let test;
let test2;
let test3;

let selAll=true;
let generi_selezionati="";

document.getElementById("choseAnother").addEventListener('click',reshow);
document.getElementById("clear").addEventListener('click',reset);

//document.querySelectorAll(".radio").forEach(element => element.addEventListener('change',placeholder_change));
document.getElementById("searchButton").addEventListener('click', research);

document.getElementById("selezionaTutto").addEventListener('click',selectAll);
document.getElementById("deselezionaTutto").addEventListener('click',unselectAll);

fetch(ANIME_API+"/GetGeneri").then(onResponse).then(getGenres);
//postpost();

function onResponse(response){
    return response.json();
}

function nextPage(){

}

function previousPage(){

}

function goTopage(event){

}

const searchBar = document.getElementById("searchBar");
const searchBarDIV = document.getElementById("searchBarDIV"); //questo è il div

function selectAll(){
    document.querySelectorAll(".genFilter").forEach(element => {
        element.checked=true;});
    selAll=true;
}

function unselectAll(){
    document.querySelectorAll(".genFilter").forEach(element => {
        element.checked=false;});
    selAll=true;
}

function research(){
    emptyResults();
    researchtext = searchBar.value;
    sfw = document.getElementById("nsfw").checked ? "false" : "true";
    let url="";
    generi_selezionati=selected_genres();
    if(generi_selezionati==""){ //ricerca normale
        //researchtext=searchGenres.value;
        //check_page();
        console.log("genere");
        url = anime_nome(researchtext,sfw,page);
        console.log(url);
    }else{ //ricerca filtrando generi
        console.log(researchtext);
        url = anime_genere(researchtext,sfw,page,generi_selezionati);
        console.log(url);
    }

    fetch(url).then(onResponse).then(showResults);
}

function emptyResults(){
    let elements = document.getElementById("content");
    while(elements.firstChild)
        elements.removeChild(elements.firstChild);
}

function selected_genres(){
    if(selAll===true)
        return "";
    let i=0,returnValue="";
    document.querySelectorAll(".genFilter").forEach(element => {
        if(element.checked){
            if(i!==0){
                returnValue+=","+element.value;
            }else{
                returnValue=element.value;
                i=1;
            }
        }
    });
    return returnValue;
}

function reset(){
    emptyResults();
    searchBar.value="";
    document.getElementById("nsfw").checked=false;
}

function getGenres(json){
    //console.log(json);
    test3 = json;
    for(let i=0;i<json.data.length;i++){
        addElementOptions(json.data[i]);
    }
    
}

async function addElementOptions(value){
    let picciriddu;
    picciriddu = document.createElement("div");
    picciriddu.appendChild(document.createElement("input"));
    picciriddu.lastChild.setAttribute("type","checkbox");
    picciriddu.lastChild.setAttribute("value",value.mal_id);
    picciriddu.lastChild.setAttribute("class","genFilter");
    picciriddu.lastChild.setAttribute("name",value.name);
    picciriddu.lastChild.addEventListener('change',() => {selAll=false;});
    picciriddu.lastChild.checked=true;
    picciriddu.appendChild(document.createElement("label"));
    picciriddu.lastChild.textContent=value.name+" - "+value.count;
    picciriddu.lastChild.setAttribute("form",value.name);

    modal_genres.appendChild(picciriddu);
}

function showResults(json){
    //stampa dei risultati
    if(json.data.length != 0){
        let results = json.data;
        for(let i=0;i<results.length;i++){
            print(results[i]);
        }
    }else{
        print404();
    }
}

function print(anime){
    let picciriddu = document.createElement("div");
    picciriddu.setAttribute("class","anime");
    //nome anime
    picciriddu.appendChild(
        document.createElement("div")
    );
    picciriddu.lastChild.setAttribute("class","nome");
    picciriddu.lastChild.appendChild(
        document.createElement("p")
    );
    //console.log(anime.titles);
    picciriddu.lastChild.firstChild.textContent = anime.title;

    //immagine copertina
    picciriddu.appendChild(
        document.createElement("div")
    );
    picciriddu.lastChild.setAttribute("class","image");
    picciriddu.lastChild.appendChild(
        document.createElement("img")
    );
    picciriddu.lastChild.firstChild.setAttribute("src", anime.images.jpg.large_image_url);
    
    picciriddu.appendChild(
        document.createElement("input")
    );
    picciriddu.lastChild.setAttribute("type","hidden");
    picciriddu.lastChild.setAttribute("value",anime.mal_id);

    picciriddu.addEventListener("click",selected);

    document.getElementById("content").appendChild(picciriddu);

}

function reshow(event){
    document.getElementsByName("main")[0].removeAttribute("id","hidden");
    document.getElementsByName("main")[0].setAttribute("id","main");

    //document.getElementsByName("research")[0].removeAttribute("id","hidden");
    //document.getElementsByName("research")[0].setAttribute("id","research");

    //document.getElementsByName("content")[0].removeAttribute("id","hidden");
    //document.getElementsByName("content")[0].setAttribute("id","content");

    document.getElementsByName("selected")[0].removeAttribute("id","selected");
    document.getElementsByName("selected")[0].setAttribute("id","hidden");
}


function selected(event){
    document.getElementsByName("main")[0].removeAttribute("id","main");
    document.getElementsByName("main")[0].setAttribute("id","hidden");

    //document.getElementsByName("research")[0].removeAttribute("id","research");
    //document.getElementsByName("research")[0].setAttribute("id","hidden");
    
    //document.getElementsByName("content")[0].removeAttribute("id","content");
    //document.getElementsByName("content")[0].setAttribute("id","hidden");

    document.getElementsByName("selected")[0].removeAttribute("id","hidden");
    document.getElementsByName("selected")[0].setAttribute("id","selected");
    

    test2 = event.path[2].cloneNode(true);

    document.getElementsByName("id")[0].value= test2.children[2].value;
    document.getElementsByName("pic")[0].value = test2.children[1].children[0].src;
    document.getElementsByName("title")[0].value = test2.children[0].children[0].textContent;
    
 
    document.getElementById("selected").removeChild(document.getElementById("selected").lastChild);
    document.getElementById("selected").appendChild(
        event.path[2].cloneNode(true)
    );

}

function print404(){
    fetch(FOX_API).then(onResponse).then(result => {
        let picciriddu = document.createElement("div");
        picciriddu.setAttribute("class","fox");
        //nome anime
        picciriddu.appendChild(
            document.createElement("div")
        );
        picciriddu.lastChild.setAttribute("class","nome");
        picciriddu.lastChild.appendChild(
            document.createElement("p")
        );
        //console.log(anime.titles);
        picciriddu.lastChild.firstChild.textContent = "Non ho trovato nessun anime, tieni una volpe :D"

        //immagine copertina
        picciriddu.appendChild(
            document.createElement("div")
        );
        picciriddu.lastChild.setAttribute("class","imageFOX");
        picciriddu.lastChild.appendChild(
            document.createElement("img")
        );
        picciriddu.lastChild.firstChild.setAttribute("src", result.image);
        document.getElementById("content").appendChild(picciriddu);
    });
    
}