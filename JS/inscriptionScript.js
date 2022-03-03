
let visible = 0;
let divT = document.getElementById("form-elem-t");
let divT2 = document.getElementById("form-elem-t2");
divT.style.display = "none";
divT2.style.display = "none";
function transChamp(){
    if(visible==0)
    {
        divT.style.display = "block";
        divT2.style.display = "block";
        visible=1;
    }
    else{
        divT.style.display = "none";
        divT2.style.display = "none";
        visible=0;
    }
    
}