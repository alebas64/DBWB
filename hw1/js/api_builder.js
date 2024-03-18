const anime_api = "//localhost/pagine/ale_hw1/api/get_anime.php";

function anime_request_build(type,ricerca,nsfw){
    return anime_api +"?"+
        "by="+type+"&"+
        "title="+ricerca+"&"+
        "nsfw="+nsfw;
}

