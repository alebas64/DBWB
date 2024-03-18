let last_post = 0;

//postpost();

function onResponse(response){
    return response.json();
}


//document.querySelectorAll('.sesso input').forEach(element => element.addEventListener('change',verifySex));

document.getElementById("choseAnother").addEventListener('click',reshow);
document.getElementById("clear").addEventListener('click',reset);

document.querySelectorAll(".radio").forEach(element => element.addEventListener('change',placeholder_change));
document.getElementById("searchButton").addEventListener('click', research);

fetch("api/get_fox.php").then(onResponse).then(result => console.log(result));
fetch("api/get_test.php").then(onResponse).then(result => console.log(result));

function placeholder_change(event){
    document.getElementById("searchBar").disabled = false;
    if(event.currentTarget.checked)
        document.getElementById("searchBar").placeholder="Inserisci "+event.currentTarget.value;
}

function research(){
    /*
    let headers = new Headers();
    headers.append("by",document.getElementsByName("by")[(document.getElementsByName("by")[0].checked == true ? 0 : 1)].value);
    headers.append("ricerca",document.getElementById("searchBar").value);
    headers.append("nsfw",document.getElementById("nsfw").checked ? "true" : "false");

    let requestOptions = {
        method: "POST",
        header: headers
    };
*/
    let url = anime_request_build(
        document.getElementsByName("by")[(document.getElementsByName("by")[0].checked == true ? 0 : 1)].value,
        document.getElementById("searchBar").value,
        document.getElementById("nsfw").checked ? "true" : "false"
    );
    fetch(url)
        .then(onResponse)
        .then(showResults);
}

let test;
reset();

function reset(){
    emptyResults();
    document.getElementById("searchBar").value="";
    document.getElementById("searchBar").placeholder="Seleziona un parametro di ricerca";
    document.getElementById("searchBar").disabled=true;
    document.getElementById("nsfw").checked=false;
    document.getElementsByName("by")[0].checked =false;
    document.getElementsByName("by")[1].checked =false;
}

function emptyResults(){
    let elements = document.getElementById("content");
    while(elements.firstChild)
        elements.removeChild(elements.firstChild);
}

function showResults(json){
    //eliminazione risultati precedenti
    emptyResults();

    //solo per visualizzare il json di risposta e provare al "volo" funzioni
    test = json;

    console.log(json);
    //stampa dei risultati
    if(json.status_code == 200){
        let results = json.data.documents;
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
    console.log(anime.titles);
    picciriddu.lastChild.firstChild.textContent = getTITLEname(anime.titles);

    //immagine copertina
    picciriddu.appendChild(
        document.createElement("div")
    );
    picciriddu.lastChild.setAttribute("class","image");
    picciriddu.lastChild.appendChild(
        document.createElement("img")
    );
    picciriddu.lastChild.firstChild.setAttribute("src", anime.cover_image);
    
    //document.getElementsByName("img")[0]

    picciriddu.appendChild(
        document.createElement("input")
    );
    picciriddu.lastChild.setAttribute("type","hidden");
    picciriddu.lastChild.setAttribute("value",anime.anilist_id);

    picciriddu.addEventListener("click",selected);

    document.getElementById("content").appendChild(picciriddu);

}

let current_selection = {
    anime_id : 0,
    anime_title: "",
    anime_pic: "",
    recensione : ""
};

function getTITLEname(titles){
    return titles.rj;
}

function reshow(event){
    document.getElementsByName("research")[0].removeAttribute("id","hidden");
    document.getElementsByName("research")[0].setAttribute("id","research");

    document.getElementsByName("content")[0].removeAttribute("id","hidden");
    document.getElementsByName("content")[0].setAttribute("id","content");

    document.getElementsByName("selected")[0].removeAttribute("id","selected");
    document.getElementsByName("selected")[0].setAttribute("id","hidden");
}

let test2;
function selected(event){
    document.getElementsByName("research")[0].removeAttribute("id","research");
    document.getElementsByName("research")[0].setAttribute("id","hidden");
    
    document.getElementsByName("content")[0].removeAttribute("id","content");
    document.getElementsByName("content")[0].setAttribute("id","hidden");

    document.getElementsByName("selected")[0].removeAttribute("id","hidden");
    document.getElementsByName("selected")[0].setAttribute("id","selected");
    

    test2 = event.path[2].cloneNode(true);
    //console.log(event);

    document.getElementsByName("id")[0].value= test2.children[2].value;
    document.getElementsByName("pic")[0].value = test2.children[1].children[0].src;
    document.getElementsByName("title")[0].value = test2.children[0].children[0].textContent;
    
    //current_selection.anime_pic = test2.children[1].children[0].src;
    //current_selection.anime_id = test2.children[2].value;
    //current_selection.anime_title = test2.children[0].children[0].textContent;

    document.getElementById("selected").removeChild(document.getElementById("selected").lastChild);
    document.getElementById("selected").appendChild(
        event.path[2].cloneNode(true)
    );

}

function print404(){
    fetch("api/get_fox.php").then(onResponse).then(result => {
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