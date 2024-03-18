
let test;
let test2;
let test3;

//document.getElementById("choseAnother").addEventListener('click',reshow);
//document.getElementById("clear").addEventListener('click',reset);

//document.querySelectorAll(".radio").forEach(element => element.addEventListener('change',placeholder_change));
document.getElementById("searchButton").addEventListener('click', research);

//document.getElementById("selezionaTutto").addEventListener('click',selectAll);
//document.getElementById("deselezionaTutto").addEventListener('click',unselectAll);

//fetch(ANIME_API+"/GetGeneri").then(onResponse).then(getGenres);
//postpost();

function onResponse(response){
    return response.json();
}

const searchBar = document.getElementById("searchBar");
//const searchBarDIV = document.getElementById("searchBarDIV"); //questo è il div

function research(event){
    event.preventDefault();
    emptyResults();
    fetch(PROFILE_ROUTE+"/search/"+searchBar.value).then(onResponse).then(showResults);
}

function emptyResults(){
    let elements = document.getElementById("content");
    while(elements.firstChild)
        elements.removeChild(elements.firstChild);
}

function reset(){
    emptyResults();
    searchBar.value="";
    document.getElementById("nsfw").checked=false;
}

function showResults(json){
    //stampa dei risultati
    console.log(json);
    if(json.result === "success"){
        let results = json.data;
        for(let i=0;i<results.length;i++){
            print(results[i]);
        }
    }else{
        print404();
    }
}

function print(user){
    let picciriddu = document.createElement("div");
    picciriddu.setAttribute("class","anime");
    //nome utente
    picciriddu.appendChild(
        document.createElement("div")
    );
    picciriddu.lastChild.setAttribute("class","nome");
    picciriddu.lastChild.appendChild(
        document.createElement("p")
    );
    //console.log(anime.titles);
    picciriddu.lastChild.firstChild.textContent = user.username;

    //immagine copertina
    picciriddu.appendChild(
        document.createElement("div")
    );
    picciriddu.lastChild.setAttribute("class","input");
    picciriddu.lastChild.appendChild(
        document.createElement("input")
    );
    picciriddu.lastChild.firstChild.setAttribute("type","button");
    picciriddu.lastChild.firstChild.value="Visualizza profilo";
    picciriddu.lastChild.firstChild.addEventListener("click",function(){
        window.location.href = PROFILE_ROUTE+"/"+user.username;
    });
    document.getElementById("content").appendChild(picciriddu);

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
        picciriddu.lastChild.firstChild.textContent = "Non ho trovato nessun utente, tieni una volpe :D"

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