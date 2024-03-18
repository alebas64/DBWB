

let selection = [null,null,null];

let d1 = [];
let d2 = [];
let d3 = [];
const choices = (document.querySelectorAll('.choice-grid div'));
document.getElementById("restart").addEventListener("click",startQuiz);
startQuiz();

function startQuiz(){
    document.getElementById("results").setAttribute("hidden","true");
    
    for(const choice of choices){
        choice.setAttribute("style","background-color: #f4f4f4;");
        choice.addEventListener('click',select);
        choice.getElementsByClassName("checkbox")[0].src="images/unchecked.png";
        choice.classList.remove("unchecked");
        choice.classList.remove("checked");
        document.getElementById("titolo").textContent="";
        document.getElementById("testo").textContent="";
        switch(choice.dataset.questionId){
            case "one":
                d1.push(choice);
                break;
    
            case "two":
                d2.push(choice);
                break;
            
            case "three":
                d3.push(choice);
        }
    }
}

function select(event){
    let scatole=null;
    let index=null;
    switch(event.currentTarget.dataset.questionId){
        case "one":
            scatole = d1;
            index=0;
            break;

        case "two":
            scatole = d2;
            index=1;
            break;
        
        case "three":
            scatole = d3;
            index=2;
    }
    
    for(const scatola of scatole){
        scatola.removeAttribute("style","background-color: #f4f4f4;");
        if(scatola.dataset.choiceId === event.currentTarget.dataset.choiceId){
            scatola.getElementsByClassName("checkbox")[0].src="images/checked.png";
            scatola.classList.remove("unchecked");
            scatola.classList.add("checked");
            selection[index]=scatola.dataset.choiceId;
        }else{
            scatola.getElementsByClassName("checkbox")[0].src="images/unchecked.png";
            scatola.classList.add("unchecked");
            scatola.classList.remove("checked");
        }
    }
    if(endCheck(selection)===true)
        endPhase();
}

function endCheck(selection){
    for(const item of selection)
        if(item===null)
            return false;
    return true;
}

function endPhase(){
    for(let choice of choices){
        choice.removeEventListener('click',select);
    }
    d1=[];d2=[];d3=[];
    showResult(RESULTS_MAP[getResult(selection)]);
    selection = [null,null,null];
}

function showResult(result){
    document.getElementById("results").removeAttribute("hidden","false");
    document.getElementById("titolo").textContent=result.title;
    document.getElementById("testo").textContent=result.contents;
}


function getResult(data){
    if(data[1] === data[2])
        return data[1];
    return data[0];
}

