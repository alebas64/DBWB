
function onResponse(response) {
    //console.log(response);
    return response.json();
}

//----------------------------------------------------------------------------
//--------------------oauth2--------------------------------------------------
//----------------------------------------------------------------------------

const client_id = "alebas2001@gmail.com";
const client_secret = "aeiou123321";
const api_outh2 = "https://kitsu.io/api/oauth/token";
const api_endP = "https://kitsu.io/api/edge";

let header = new Headers();
header.append("Accept","application/vnd.api+json");
header.append("Content-Type","application/vnd.api+json");

function token_kitsu(){
        let formdata = new FormData();
        formdata.append("grant_type","password");
        formdata.append("username",client_id);
        formdata.append("password",client_secret);

        let requestOptions = {
            method : "POST",
            body : formdata
        };
        fetch(api_outh2,requestOptions)
            .then(onResponse)
            .then(result => {
                //console.log(result);
                header.append("Authorizazion", "Bearer "+result.access_token);
                getInfo();
            }
            );
}

function getInfo(){
    let requestOptions ={
        method: "GET",
        headers : header
    };

    let queries=[
        "/anime?filter[slug]=cowboy-bebop",
        "/anime?filter[slug]=shokugeki-no-souma",
        "/anime?filter[slug]=initial-d-first-stage",
        "/anime?filter[slug]=kill-la-kill",
        "/anime?filter[slug]=one-punch-man",
        "/anime?filter[slug]=attack-on-titan",
        "/anime?filter[slug]=naruto-shippuden",
        "/anime?filter[slug]=death-note",
        "/anime?filter[slug]=neon-genesis-evangelion"
    ];
    
    let question_id = ["blep","burger","cart","dopey","happy","nerd","shy","sleeping","sleepy"];

    for(let i=0;i<9;i++){
        fetch("https://kitsu.io/api/edge"+queries[i],requestOptions)
        .then(onResponse)
        .then(result => {
            //console.log(result);
            RESULTS_MAP[question_id[i]].title = result.data[0].attributes.canonicalTitle;
            RESULTS_MAP[question_id[i]].image = result.data[0].attributes.posterImage.medium;
            RESULTS_MAP[question_id[i]].contents = result.data[0].attributes.description;
            
        });
    }
}

//----------------------------------------------------------------------------
//-----------------no oauth2--------------------------------------------------
//----------------------------------------------------------------------------

function foxes(){
    let target = "[data-question-id='one'] [data-img-id='";
    for(let i=0;i<9;i++)
        fetch('https://randomfox.ca/floof/').then(onResponse).then(json => {
            //console.log(json);
            document.querySelectorAll(target + i + "']")[0]
                .src = json["image"];
        });
}