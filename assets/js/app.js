window.onload = function(){
    
    var create = document.getElementById("create");
    create.addEventListener("click", createLines );
    /*var remove = document.getElementById("remove");
    remove.addEventListener("click", removeLines );*/

    var coordArray = [[],[]];
    
    var showArr = document.getElementById("showArray");
    showArr.addEventListener("click", showArray );



/*ЖАРА С ВЕРТИКАЛЬНОЙ РАЗМЕТКОЙ*/

function createLines(){
/* Начальные установки*/    
    var image = document.getElementById("image");
/*Пошла жара*/    
    var lineX = document.createElement("div");
    var lineY = document.createElement("div");
    
    lineX.id = "lineX";
    lineY.id = "lineY";
    image.appendChild(lineX);
    image.appendChild(lineY);

    image.addEventListener("mousemove", lookForPosition );
    image.addEventListener("click", setLines );
}

function lookForPosition(e){
    var xPos = e.pageX;
    var yPos = e.pageY;
    var X = document.getElementById("lineX");
    var Y = document.getElementById("lineY");
    X.style.left = xPos+"px";
    Y.style.top = yPos+"px";
}
function setLines(e){
    var pageX = e.pageX;
    var pageY = e.pageY;
    var image = document.getElementById("image");
    var coords = document.getElementById("coords");
    
    var lineX = document.createElement("div");
    var lineY = document.createElement("div");
    
    lineX.className = "newLineX";
    image.appendChild(lineX);
    lineX.style.left = pageX+"px";
    
    lineY.className = "newLineY";
    image.appendChild(lineY);
    lineY.style.top = pageY+"px";
    
    coords.innerHTML += `<p>X:${pageX}, Y: ${pageY}</p>`;
    coordArray[0].push(pageX);
    coordArray[1].push(pageY);
}
   

/*ЖАРА С МАССИВОМ*/
    function showArray(){
        alert("X:"+coordArray[0]+"; Y:"+coordArray[1]);
    }

}