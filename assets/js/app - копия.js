window.onload = function(){
    
    var createX = document.getElementById("createX");
    createX.addEventListener("click", createLineX );
    
    var createY = document.getElementById("createY");
    createY.addEventListener("click", createLineY );

    var coordArray = [[],[]];
    
    var showArr = document.getElementById("showArray");
    showArr.addEventListener("click", showArray );



/*ЖАРА С ВЕРТИКАЛЬНОЙ РАЗМЕТКОЙ*/

function createLineX(){
/* Начальные установки*/    
    var image = document.getElementById("image");
    if(document.getElementById("line") !== null){
        image.removeEventListener("mousemove", lookForPositionY);
        image.removeEventListener("click", setLineY);
        image.removeChild(document.getElementById("line"));
    }
/*Пошла жара*/    
    var line = document.createElement("div");
    line.className = "lineX";
    line.id = "line";
    image.appendChild(line);
    
    image.addEventListener("mousemove", lookForPositionX);
    image.addEventListener("click", setLineX);
}

function lookForPositionX(e){
    var pageX = e.pageX;
    var line = document.getElementById("line");
    line.style.left = pageX+"px";
}
function setLineX(e){
    var pageX = e.pageX;
    var image = document.getElementById("image");
    var coords = document.getElementById("coords");
    
    var line = document.createElement("div");
    line.className = "newLineX";
    image.appendChild(line);
    line.style.left = pageX+"px";
    
    coords.innerHTML += "<p>x: "+pageX+"</p>";
    coordArray[0].push(pageX);
}



/*ЖАРА С ГОРИЗОНТАЛЬНОЙ РАЗМЕТКОЙ*/

function createLineY(){
/* Начальные установки*/    
    var image = document.getElementById("image");
    if(document.getElementById("line") !== null){
        image.removeEventListener("mousemove", lookForPositionX);
        image.removeEventListener("click", setLineX);
        image.removeChild(document.getElementById("line"));
    }
/*Пошла жара*/    
    var line = document.createElement("div");
    line.className = "lineY";
    line.id = "line";
    image.appendChild(line);
    
    image.addEventListener("mousemove", lookForPositionY);
    image.addEventListener("click", setLineY);
}

function lookForPositionY(e){
    var pageY = e.pageY;
    var line = document.getElementById("line");
    line.style.top = pageY+"px";
}
function setLineY(e){
    var pageY = e.pageY;
    var image = document.getElementById("image");
    var coords = document.getElementById("coords");
    
    var lineY = document.createElement("div");
    lineY.className = "newLineY";
    image.appendChild(lineY);
    lineY.style.top = pageY+"px";
    
    coords.innerHTML += "<p>y: "+pageY+"</p>";
    coordArray[1].push(pageY);
}

/*ЖАРА С МАССИВОМ*/
function showArray(){
    alert("X:"+coordArray[0]+"; Y:"+coordArray[1]);
}

}