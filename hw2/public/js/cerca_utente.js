function load(event){
    const risp = event.currentTarget;
    const valore = risp.dataset.id;

    //console.log(valore);
    if(valore === 'nome'){
      if(cerca_nome.classList.value !== 'onok'){
        cerca_nome.classList.add('onok');
        users_view.classList.remove('onok');
      }else {
        cerca_nome.classList.remove('onok');
        anime_view.classList.add('off');
        esposizione.classList.add('off');
        lista1.classList.add('off');
      }
    }else{
       // console.log(users_view);
        if(users_view.classList.value !== 'onok'){
            //console.log('ciao');
            users_view.classList.add('onok');
            if(cerca_nome.classList.value === 'onok'){
                cerca_nome.classList.remove('onok');
            }
            lista1.classList.add('off');
            anime_view.classList.add('off');
            anime_view.classList.add('off');
            esposizione.classList.add('off');
            //console.log(UTENTE_ROUTE);
            fetch(UTENTE_ROUTE + "/request_all_users").then(onResponse).then(onJson2);
        }else {
            users_view.classList.remove('onok');
            esposizione.classList.add('off');
            anime_view.classList.add('off');
            lista1.classList.add('off');
        }
    }
}
  


function onJson2(json){ 
    users_view.innerHTML=' ';
    //console.log("Stampo il json ricevuto"); console.log(json);     
    for(let i=0; i<json.length;i++){
       //console.log(json[i]);
        const div_contenitore=document.createElement('div'); 
        const img=document.createElement('img'); 
		img.src=json[i].url_img; 
        const div_nome=document.createElement('div'); 
		div_nome.textContent= json[i].nome;
        const id = json[i].id; 
        div_contenitore.appendChild(img); 
        div_contenitore.appendChild(div_nome);
        div_contenitore.classList.add('spazio');
        div_contenitore.setAttribute('data-user', json[i].username);
        users_view.appendChild(div_contenitore); 
    }
    const select = document.querySelectorAll('#users-view div');
    for (let sel of select){
        sel.addEventListener('click', cerca);
    }
}

function cerca_tutti(){
    users_view.classList.add('onok');
    esposizione.classList.add('off');
    lista1.classList.remove('On');
    anime_view.classList.add('off');
    fetch(UTENTE_ROUTE + "/request_all_users").then(onResponse).then(onJson2);
}



const div_nome = document.querySelectorAll('#scelta div');
for(let i of div_nome){
   i.addEventListener('click', load);
}

function onResponse(response){ 
    return response.json(); 
}

   
function onJson(json){ 
    esposizione.classList.add('onok');
    esposizione.classList.remove('off');
    lista1.classList.remove('off');
    esposizione.innerHTML=' ';
    //console.log("Stampo il json ricevuto"); console.log(json); 
    if ( json === "Nessun risultato" ){
        const div_risultati=document.createElement('div');
        div_risultati.textContent=json;
        esposizione.appendChild(div_risultati);
    }else {
        const div_contenitore=document.createElement('div'); 
        if(cerca_nome.classList.value !== 'onok'){
            const back = document.createElement('span');
            back.classList.add('back');
            div_contenitore.appendChild(back);
        }
        //console.log(json[i]);
        
        const img=document.createElement('img'); 
		img.src=json[0].url_img; 
        const div_nome_cognome = document.createElement('div');
		const div_nome=document.createElement('div'); 
		div_nome.textContent= json[0].nome; 
    	const div_cognome=document.createElement('div'); 
		div_cognome.textContent= json[0].cognome; 
        const div_username=document.createElement('div'); 
		div_username.textContent= json[0].username;
        const username = json[0].username;
        div_contenitore.appendChild(img); 
        div_nome_cognome.appendChild(div_nome);
        div_nome_cognome.appendChild(div_cognome);
        div_contenitore.appendChild(div_nome_cognome); 
		div_contenitore.appendChild(div_username); 
        div_contenitore.classList.add('spazio'); 
        div_nome_cognome.classList.add('order');
        esposizione.appendChild(div_contenitore); 
        fetch(UTENTE_ROUTE + "/request_anime/" + username).then(onResponse).then(onJson1);
    }
    if(cerca_nome.classList.value !== 'onok'){
        const b = document.querySelector('.back');
        b.addEventListener('click', cerca_tutti);
    }
}

function onJson1(json){ 
    users_view.classList.remove('onok');
    box.innerHTML=' ';
    box.classList.remove('off');
    //console.log("Stampo il json ricevuto"); console.log(json);     
    lista1.classList.add("On");
    if ( json === "Nessun anime in lista" ){
        const div_risultati=document.createElement('div');
        div_risultati.textContent=json;
        box.appendChild(div_risultati);
    }else {
        for(let i=0; i<json.length;i++){
            //console.log(json[i]);
            const div_contenitore=document.createElement('div'); 
            const img=document.createElement('img'); 
		    img.src=json[i].url_img; 
            const div_nome=document.createElement('div'); 
		    div_nome.textContent= json[i].nome;
            const anilist_id = json[i].anilist_id; 

		    div_contenitore.appendChild(img); 
            div_contenitore.appendChild(div_nome);
            div_contenitore.classList.add('cont');
            div_contenitore.setAttribute('data-id', anilist_id);
            box.appendChild(div_contenitore); 
        }
    }
}

function cerca(event){ 
    let cercausername;
    if ( cerca_nome.classList.value === 'onok'){
        cercausername= form.cercausername.value; 
        username = cercausername;
        //console.log(cercausername);
    }else {
       cercausername = event.currentTarget.dataset.user;
    }
    fetch(UTENTE_ROUTE +"/request_search_users/"+cercausername).then(onResponse).then(onJson);
    event.preventDefault();
}


const form = document.querySelector('form'); 
form.addEventListener('submit',cerca);

const esposizione = document.querySelector("#user-view");
const box = document.querySelector("#anime-view");
const cerca_nome = document.querySelector('#cerca');
const anime_view = document.querySelector('#anime-view');
const lista1 = document.querySelector('.lista');
const users_view = document.querySelector('#users-view');