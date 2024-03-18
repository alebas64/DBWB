function anime_nome(ricerca,nsfw,page){
    return ANIME_API +"/"+
        "ByName/"+
        ricerca+"/"+
        nsfw+"/"+
        page;
}

function anime_genere(ricerca,nsfw,page,generi){
    return ANIME_API +"/"+
        "ByGenere/"+
        ricerca+"/"+
        generi+"/"+
        nsfw+"/"+
        page;
}

