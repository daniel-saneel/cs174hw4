var selected;
var permuted; 
function ClickTile(div){
    if(selected == div){
    selected = null;
    div.style.border = "1px black solid";
    return false;
   }
   else if(selected !=null && selected!=undefined){
    div.style.border = "1px black solid";
    selected.style.border = "1px black solid";
    var middle = selected.className;
    selected.className = div.className;
    div.className= middle;
    selected = null;
    // ajaxCall(selected,div);
   }
   else{
       selected = div;
       div.style.border = "5px blue dashed";
   }
}