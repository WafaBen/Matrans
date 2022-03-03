let visible = 0;
let divT = document.getElementById("myPopup");
divT.style.display = "none";
function showModel(){
    console.log("hello");
    if(visible==0)
    {
        divT.style.display = "block";
        visible=1;
    }
    else{
        divT.style.display = "none";
        visible=0;
    }
    
}