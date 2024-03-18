let valori = [ 'Action', 'Adventure', 'Cars', 'Comedy', 'Avante Garde', 'Demons', 'Mystery', 'Drama', 'Ecchi',
               'Fantasy', 'Game', 'Hentai', 'Historical', 'Horror', 'Kids', 'Martial Arts', 'Mecha',
               'Music','Parody', 'Samurai','Romance', 'School','Sci Fi','Shoujo','Girls Love','Shounen','Boys Love',
               'Space','Sports','Super Power','Vampire','Harem','Slice Of Life', 'Supernatural', 'Military','Police',
               'Psychological', 'Suspense','Seinen', 'Josei'
              ];

let check = ['uno_checked', 'due_unchecked', 'tre_unchecked', 'quattro_unchecked', 'cinque_unchecked'];
let check2 = ['uno_unchecked', 'due_checked', 'tre_unchecked', 'quattro_unchecked', 'cinque_unchecked'];
let check3 = ['uno_unchecked', 'due_unchecked', 'tre_checked', 'quattro_unchecked', 'cinque_unchecked'];
let check4 = ['uno_unchecked', 'due_unchecked', 'tre_unchecked', 'quattro_checked', 'cinque_unchecked'];
let check5 = ['uno_unchecked', 'due_unchecked', 'tre_unchecked', 'quattro_unchecked', 'cinque_checked'];
let check_val = ['uno', 'due', 'tre', 'quattro', 'cinque'];

function load(event){
  const risp = event.currentTarget;
  const valore = risp.dataset.id;
  const cerca_nome = document.querySelector('#cerca');
  const cerca_genere = document.querySelector('#cerca_genere');
  const anime_view = document.querySelector('#anime-view');
  const anime = document.querySelector('#anime');
  const page = document.querySelector('#page');
  //console.log(valore);
  if(valore === 'nome'){
    if(cerca_nome.classList.value !== 'onok'){
      cerca_nome.classList.add('onok');
      page.classList.add('off');
    }else {
      cerca_nome.classList.remove('onok');
      anime_view.classList.add('off');
      page.classList.add('off');
    }
    if(cerca_genere.classList.value === 'onok'){
      cerca_genere.classList.remove('onok');
      anime_view.classList.add('off');
      anime.classList.add('off');
    }
  }else if (valore === 'genere'){
    if(cerca_genere.classList.value !== 'onok'){
      cerca_genere.classList.add('onok');
      page.classList.add('off');
      riempi();
    }else {
      cerca_genere.classList.remove('onok');
      anime_view.classList.add('off');
      page.classList.add('off');
    }
    if(cerca_nome.classList.value === 'onok'){
      cerca_nome.classList.remove('onok');
      anime_view.classList.add('off');
      anime.classList.add('off');
    }
  }
}

const div_nome = document.querySelectorAll('#scelta div');
for(let i of div_nome){
   i.addEventListener('click', load);
}

function riempi(){
  const val = document.querySelector('#cerca_genere');
  val.innerHTML = '';
  val.textContent = 'Scegli il genere:';
  const divblock = document.createElement('div');
  let h = 1;
  for(let i of valori){
    const div_contenitore = document.createElement('label');
    const input = document.createElement('input');
    input.type = 'radio';
    input.name = 'genere';
    input.value = h;
    div_contenitore.textContent = i;
    div_contenitore.appendChild(input);
    div_contenitore.classList.add('stile');
    divblock.appendChild(div_contenitore);
    h+=1;
  }
  divblock.classList.add('block');
  val.appendChild(divblock);
  const sub = document.createElement('input');
  sub.type= 'submit';
  sub.id= 'submit';
  sub.value = 'cerca';
  val.appendChild(sub);
  const sumbit = document.querySelector('#cerca_genere');
  sumbit.addEventListener('submit', cerca_anime);
}

function cerca_anime(event){
  const select = document.querySelectorAll('label input');
  let valore;
  controller = true;
  control1= true;
  for (let i of select){
    if (i.checked){
      //console.log(i.value);
      valore = i.value;
    }
  }
  fetch(ANIME_ROUTE +"/genere/" +valore + "/" +page_num).then(onResponse).then(onJson);

  event.preventDefault();
}
function cerca_anime2(event){
  const select = document.querySelectorAll('label input');
  let valore;
  controller = false;
  for (let i of select){
    if (i.checked){
      //console.log(i.value);
      valore = i.value;
    }
  }
  fetch(ANIME_ROUTE +"/genere/" +valore + "/" +page_num).then(onResponse).then(onJson);
  event.preventDefault();
}

function onJson(json) {
  window.scroll(0,0);
  //console.log('JSON ricevuto'); console.log(json);
  const library = document.querySelector('#anime-view');
  library.innerHTML = '';
  library.classList.remove('off');
  const section = document.querySelector('#anime');
  section.innerHTML = '';
  section.classList.add('off');   
  const results = json.data;
  const num_page = json.pagination;
  //console.log(json.pagination);
  let num_result;
  //console.log(results.length);  
  if(controller === true){
    if(num_page.last_visible_page >=5){
      lent = 5;
    }else if(num_page.last_visible_page === 1){
      lent = 1;
    }else if(num_page.last_visible_page === 2){
      lent = 2;
    }else if(num_page.last_visible_page === 3){
      lent = 3;
    }else if(num_page.last_visible_page === 4){
      lent = 4;
    }
  }
    //console.log(lent); //console.log('if');
    const page = document.querySelector('#page');
    page.innerHTML = '';
    page.classList.remove('off');
    //console.log(page.classList.value);
    for (let i = 0; i<lent; i++){
      const num = document.createElement('div');
      //console.log(control1);
      if(control1){
        num.classList.add(check[i]);
      }else if(control2){
        num.classList.add(check2[i]);
      }else if(control3){
        num.classList.add(check3[i]);
      }else if(control4){
        num.classList.add(check4[i]);
      }else{
        num.classList.add(check5[i]);
      }
      num.id = check_val[i];
      page.appendChild(num); 
    }
    const pages = document.querySelectorAll('#page div');
    for( let p of pages){
      p.addEventListener('click', gira);
    }
  

  num_result = json.data.length;
  for(let i = 0; i<num_result; i++){
    const album_data = results[i];
    const cover_image = album_data.images.jpg.image_url;
    const album = document.createElement('div');
    const img = document.createElement('img');
    img.src = cover_image;
    const anilist_id = album_data.mal_id;
    album.appendChild(img);
    album.setAttribute('data-id', anilist_id);
    library.appendChild(album);
  }    
  let risposte = document.querySelectorAll('#anime-view div');
  for(const risp of risposte){ 
    risp.addEventListener('click', controllo);
  }  
}

function gira(event){
  event.preventDefault(); 
  const varl = event.currentTarget; 
  //console.log(varl.classList.value);
  const uno = document.querySelector('#uno');
  if(lent === 2){
    const due = document.querySelector('#due');
    if(varl.classList.value === 'due_unchecked'){
      due.classList.add('due_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      page_num =2;
      control2 = true;
      control1 = false;
    }else {
      due.classList.add('due_unchecked');
      uno.classList.add('uno_checked');
      due.classList.remove('due_checked');
      page_num = 1;
      control1 = true;
      control2 = false;
    }
  }else if(lent === 3){
    const due = document.querySelector('#due');
    const tre = document.querySelector('#tre');
    if(varl.classList.value === 'tre_unchecked'){
      tre.classList.add('tre_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      due.classList.add('due_unchecked');
      due.classList.remove('due_checked');
      page_num = 3;
      control3 = true;
      control2 = false;
      control1 = false;
    }else if(varl.classList.value === 'due_unchecked') {
      due.classList.add('due_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      page_num = 2;
      control3 = false;
      control2 = true;
      control1 = false;
    }else{
      due.classList.add('due_unchecked');
      uno.classList.add('uno_checked');
      due.classList.remove('due_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      page_num = 1;
      control3 = false;
      control2 = false;
      control1 = true;
    }
  }else if (lent === 4){
    const due = document.querySelector('#due');
    const tre = document.querySelector('#tre');
    const quattro = document.querySelector('#quattro');
    if(varl.classList.value === 'quattro_unchecked'){
      quattro.classList.add('quattro_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      due.classList.add('due_unchecked');
      due.classList.remove('due_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      page_num = 4;
      control4 = true;
      control3 = false;
      control2 = false;
      control1 = false;
    }
    else if(varl.classList.value === 'tre_unchecked'){
      tre.classList.add('tre_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      due.classList.add('due_unchecked');
      due.classList.remove('due_checked');
      quattro.classList.add('quattro_unchecked');
      quattro.classList.remove('quattro_checked');
      page_num = 3;
      control4 = false;
      control3 = true;
      control2 = false;
      control1 = false;
    }else if(varl.classList.value === 'due_unchecked') {
      due.classList.add('due_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      quattro.classList.add('quattro_unchecked');
      quattro.classList.remove('quattro_checked');
      page_num = 2;
      control4 = false;
      control3 = false;
      control2 = true;
      control1 = false;
    }else{
      due.classList.add('due_unchecked');
      uno.classList.add('uno_checked');
      due.classList.remove('due_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      quattro.classList.add('quattro_unchecked');
      quattro.classList.remove('quattro_checked');
      page_num = 1;
      control4 = false;
      control3 = false;
      control2 = false;
      control1 = true;
    }
  }else {
    const due = document.querySelector('#due');
    const tre = document.querySelector('#tre');
    const quattro = document.querySelector('#quattro');
    const cinque = document.querySelector('#cinque');
    if(varl.classList.value === 'cinque_unchecked'){
      cinque.classList.add('cinque_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      due.classList.add('due_unchecked');
      due.classList.remove('due_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      quattro.classList.add('quattro_unchecked');
      quattro.classList.remove('quattro_checked');
      page_num = 5;
      control5 = true;
      control4 = false;
      control3 = false;
      control2 = false;
      control1 = false;
    }
    else if(varl.classList.value === 'quattro_unchecked'){
      quattro.classList.add('quattro_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      due.classList.add('due_unchecked');
      due.classList.remove('due_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      cinque.classList.add('cinque_unchecked');
      cinque.classList.remove('cinque_checked');
      page_num = 4;
      control5 = false;
      control4 = true;
      control3 = false;
      control2 = false;
      control1 = false;
    }
    else if(varl.classList.value === 'tre_unchecked'){
      tre.classList.add('tre_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      due.classList.add('due_unchecked');
      due.classList.remove('due_checked');
      quattro.classList.add('quattro_unchecked');
      quattro.classList.remove('quattro_checked');
      cinque.classList.add('cinque_unchecked');
      cinque.classList.remove('cinque_checked');
      page_num = 3;
      control5 = false;
      control4 = false;
      control3 = true;
      control2 = false;
      control1 = false;
    }else if(varl.classList.value === 'due_unchecked') {
      due.classList.add('due_checked');
      uno.classList.add('uno_unchecked');
      uno.classList.remove('uno_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      quattro.classList.add('quattro_unchecked');
      quattro.classList.remove('quattro_checked');
      cinque.classList.add('cinque_unchecked');
      cinque.classList.remove('cinque_checked');
      page_num = 2;
      control5 = false;
      control4 = false;
      control3 = false;
      control2 = true;
      control1 = false;
    }else{
      due.classList.add('due_unchecked');
      uno.classList.add('uno_checked');
      due.classList.remove('due_checked');
      tre.classList.add('tre_unchecked');
      tre.classList.remove('tre_checked');
      quattro.classList.add('quattro_unchecked');
      quattro.classList.remove('quattro_checked');
      cinque.classList.add('cinque_unchecked');
      cinque.classList.remove('cinque_checked');
      page_num = 1;
      control5 = false;
      control4 = false;
      control3 = false;
      control2 = false;
      control1 = true;
    }
  }
  const cerca_genere = document.querySelector('#cerca_genere');
  if(cerca_genere.classList.value === 'onok'){
     cerca_anime2(event);
  }else{
    search2(event);
  }
}

function onResponse(response) {
  //console.log('Risposta ricevuta');
  return response.json();
}

function onJson1(json) {
  //console.log('JSON ricevuto');
  const library = document.querySelector('#anime');
  library.innerHTML = '';
  library.classList.remove('off');
  const section = document.querySelector('#anime-view');
  section.innerHTML = '';
  section.classList.add('off');
  //console.log('JSON ricevuto'); console.log(json); 
  const results = json.data;
  const album_data = results;
  const cover_image = album_data.images.jpg.image_url;
  img_url = cover_image;
  const text = album_data.title;
  nome = text;
  const anilist_id = album_data.mal_id;
  id = anilist_id;
  const ep = album_data.duration;
  const cont_ep = album_data.episodes;
  let descr = album_data.synopsis;
  const album = document.createElement('div');
  const star = document.createElement('div');
  if(control === 'true'){
    star.classList.add('star_off_1');
    star.id ='star'
  }else {
    star.classList.add('star_off');
    star.id ='star'
  }
  const back = document.createElement('span');
  back.classList.add('back');
  const box = document.createElement('span');
  const img = document.createElement('img');
  img.src = cover_image;
  const title = document.createElement('span');
  title.textContent= text;
  const descriptions = document.createElement('span');
  descriptions.textContent= descr;
  const ep_time = document.createElement('span');
  ep_time.textContent = ep;
  const ep_num = document.createElement('span');
  ep_num.textContent = "Numero episodi: " + cont_ep;
  box.appendChild(descriptions);
  album.appendChild(back);
  album.appendChild(star);
  album.appendChild(img);
  album.appendChild(title);
  album.appendChild(ep_num);
  album.appendChild(ep_time);
  album.setAttribute('data-id', anilist_id);
  library.appendChild(album);
  library.appendChild(box);   
  const cerca = document.querySelector('#cerca');
  const b = document.querySelector('.back');
  if(cerca.classList.value === 'onok'){
    b.addEventListener('click', search2);  
  } else {
    b.addEventListener('click', cerca_anime2);
  }
  const l = document.querySelector('#star');
  //console.log(l);
  l.addEventListener('click', lista);
}
  
function search(event){ 
  controller = true;
  control1=true; 
  const name_value = form.name.value;
  nome = name_value;
  //console.log('Eseguo ricerca: ' +  name_value);
  fetch(ANIME_ROUTE + "/cerca/"+name_value + "/" +page_num).then(onResponse).then(onJson);
  event.preventDefault();  
}

function search2(event){ 
  controller = false;
  const name_value = form.name.value;
  nome = name_value;
  //console.log('Eseguo ricerca: ' +  name_value);
  fetch(ANIME_ROUTE + "/cerca/"+name_value + "/" +page_num).then(onResponse).then(onJson);
  event.preventDefault();  
}

function anime(anilist_id){
  //console.log(anilist_id);
  const page = document.querySelector('#page');
  page.classList.add('off');
  fetch(ANIME_ROUTE +"/cerca2/"+ anilist_id).then(onResponse).then(onJson1);
  const library = document.querySelector('#anime-view');
  library.classList.add('off');

}

function onJson2(json) {
  //console.log('JSON ricevuto'); console.log(json);
  const boolean = json[0];
  //console.log(boolean);
  control = boolean;
  const anilist_id = json[1];
  anime(anilist_id);
}

function controllo(event){
  //console.log('sono controllo');
  const risp = event.currentTarget; 
  const anilist_id = risp.dataset.id ;
  // console.log(anilist_id); // console.log('Eseguo controllo: ' +  anilist_id);
  fetch(ANIME_ROUTE + "/controllo_lista/"+ anilist_id).then(onResponse).then(onJson2);
}

const form = document.querySelector('#cerca');
form.addEventListener('submit', search);

 function lista(event){
  event.preventDefault();
  const l = document.querySelector('#star');
  if(l.classList.value === 'star_off'){
    l.classList.add('star_off_1');
    l.classList.remove('star_off');
    //console.log(nome);
    fetch(ANIME_ROUTE + "/lista/"+ nome + "/" + encodeURIComponent(img_url) + "/" + id).then(onResponse).then(onJson6);
  }else{
    l.classList.add('star_off');
    l.classList.remove('star_off_1'); 
    fetch(LISTA_ROUTE + "/delete/" + id);   
  }
}

function onJson6(json){
console.log(json);
}
let nome;
let img_url;
let id;
let control;
let control1 = true;
let control2;
let control3;
let control4;
let control5;
let controller = true;
let lent = 0;
let page_num = 1;