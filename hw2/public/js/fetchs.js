let last_post = 0;
let test1;

//postpost();

function onResponse(response){
    return response.json();
}

let test;
let a;

function print_single(single){
    let pointer; //variabile usata solo per tenere "pulito" il codice
    let sub_pointer;
    let picciriddu = document.createElement("div");
    picciriddu.setAttribute("class","post");

    picciriddu.appendChild(
        document.createElement("section")
    );

    //punto alla prima section, quella con l'immagine ed il testo
    pointer = picciriddu.lastChild;
    pointer.appendChild(
        document.createElement("div")
    );

    //immagine di copertina
    sub_pointer = pointer.lastChild; //al div
    sub_pointer.setAttribute("class","animePIC"); 
    sub_pointer.appendChild(
        document.createElement("img")
    );
    sub_pointer.lastChild.setAttribute("src",single["image"]);

    //parte del testo
    pointer.appendChild(
        document.createElement("div")
    );
    sub_pointer = pointer.lastChild; //al div .userContent
    sub_pointer.setAttribute("class","userContent");
    sub_pointer.appendChild(
        document.createElement("div")
    );
    sub_pointer = sub_pointer.lastChild; //al div che conterrà .animeTITLE
        sub_pointer.appendChild(
            document.createElement("p")
        );
        sub_pointer.lastChild.setAttribute("class","animeTITLE");
        sub_pointer.lastChild.textContent = single["title"];
    
    sub_pointer = pointer.lastChild; //al div .userContent
    sub_pointer.appendChild(
        document.createElement("div")
    );
    sub_pointer = sub_pointer.lastChild; //al div che conterrà .description
        sub_pointer.appendChild(
            document.createElement("p")
        );
        sub_pointer.lastChild.setAttribute("class","description");
        sub_pointer.lastChild.textContent = single["descrizione"];
    
    
    //creazione seconda section
    picciriddu.appendChild(
        document.createElement("section")
    );
    //punto alla seconda section, quella con likes,commenti,creatore e data
    pointer = picciriddu.lastChild;
    pointer.appendChild(
        document.createElement("div")
    );
    sub_pointer = pointer.lastChild; //punto al div che conterrà .creatirTag e .creationDate
    sub_pointer.appendChild(
        document.createElement("div")
    );
        sub_pointer = sub_pointer.lastChild;
        sub_pointer.appendChild(
            document.createElement("p")
        );
        sub_pointer.lastChild.setAttribute("class","creatorTag");
        sub_pointer.lastChild.textContent = single["user"];
    
    sub_pointer = pointer.lastChild; //punto al div che conterrà .creatirTag e .creationDate
    sub_pointer.appendChild(
        document.createElement("div")
    );
        sub_pointer = sub_pointer.lastChild;
        sub_pointer.appendChild(
            document.createElement("p")
        );
        sub_pointer.lastChild.setAttribute("class","creationDate");
        sub_pointer.lastChild.textContent = single["createdOn"];

    pointer.appendChild(
        document.createElement("div")
    );
    sub_pointer = pointer.lastChild; //punto al div che conterrà .nLikes_comments
    sub_pointer.appendChild(
        document.createElement("div")
    );
        sub_pointer = sub_pointer.lastChild; //creazione master
        sub_pointer.setAttribute("class","nLikes_comments");
        //sub_pointer.setAttribute("name",single["name"]);
        //sub_pointer.addEventListener("click",change_likes);
        sub_pointer.appendChild(
            document.createElement("div")
        );
            sub_pointer.lastChild.setAttribute("class","sub"); //creazione sub per likes
            sub_pointer.lastChild.setAttribute("name",single["name"]);
            sub_pointer.lastChild.addEventListener("click",change_likes);
            sub_pointer.lastChild.appendChild(
                document.createElement("img")
            );
            sub_pointer.lastChild.lastChild.setAttribute("class","likes-comments");
            
            sub_pointer.lastChild.lastChild.src= single["liked"] == "si" ? IMAGE_ROUTE+"/like.png" : IMAGE_ROUTE+"/nolike.png";

            sub_pointer.lastChild.appendChild(
                document.createElement("p")
            );
            sub_pointer.lastChild.lastChild.textContent=single["likes"];

            sub_pointer.appendChild(
                document.createElement("div")
            );
            sub_pointer = pointer.lastChild.lastChild;
            sub_pointer.lastChild.setAttribute("class","sub"); //creazione sub per commenti
            sub_pointer.lastChild.setAttribute("name",single["name"]);
            sub_pointer.lastChild.addEventListener("click",show_comments);
            sub_pointer.lastChild.appendChild(
                document.createElement("img")
            );
            sub_pointer.lastChild.lastChild.setAttribute("class","likes-comments");
            sub_pointer.lastChild.lastChild.src= IMAGE_ROUTE+"/comments.png";
            
/*
            sub_pointer.appendChild(
                document.createElement("div")
            );*/
                sub_pointer.lastChild.appendChild(
                    document.createElement("p")
                );
                sub_pointer.lastChild.lastChild.textContent=single["comments"];
    /*
    picciriddu.appendChild(
        document.createElement("section")
    );
    
    pointer = picciriddu.lastChild;
    pointer.setAttribute("class","hidden");
    pointer.setAttribute("class","comment");*/
    //inserimento nella pagina
    document.getElementById("content").appendChild(picciriddu);

    test1 = picciriddu; //solo per debug
    last_post = single["timestamp"]; //per prossima fetch
    
}

function postpost(indirizzo){
    fetch(indirizzo).then(onResponse).then(json => {
        console.log(json);
        /*
        test = result;
        let data = result.data;
        //document.getElementById("content").appendChild("div").append
        for(let i=0;i<data.length;i++){
            print_single(data[i]);
        }*/
        if(json.result === "success"){
            let results = json.data;
            for(let i=0;i<results.length;i++){
                print_single(results[i]);
            }
        }else{
            print404();
        }
    /*
        if(result.length < 10){
            //stampa volpe, non c'è più niente
            console.log("fkabfkhbdsajhb");
        }*/
    });
}

/*
function check_liked(html_img){
    fetch("check_liked.php");
}

function like_unlike(event){

}
*/


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
        picciriddu.lastChild.firstChild.textContent = "Non ho trovato nulla, tieni una volpe :D"

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

//fetch("api/get_fox.php").then(onResponse).then(result => console.log(result));
//fetch("api/get_test.php").then(onResponse).then(result => console.log(result));