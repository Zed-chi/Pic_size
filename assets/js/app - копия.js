window.onload = function(){
    var image = document.getElementById("image");
        image.addEventListener("mousedown", makeGrid );
        image.addEventListener("mousemove", resizeGrid );
        image.addEventListener("mouseup", fillGrid );

    var save  = document.getElementById("saveCurMarkup");
        save.addEventListener("click", saveToJson);
    
    var coords =     {};
    var origin =     [];
    var origPos  =   [];
    var moveOrigin = [];
    var idTo = 0;
    var isDown =     false;
    var selected =   false;
    var pattern = document.getElementById("makeAsPattern");
        pattern.addEventListener("click", makeLike);
    
    var process = document.getElementById("processIt");
    var data = document.getElementById("data");
    init();

//Обрезать по шаблону
function makeLike(){
    if(document.getElementById("grid")){
        var li_s = document.getElementsByTagName("li");
        var length = li_s.length;
        for(var i=0; i<length; i+=1){
            coords[i] = setJSONProp();
        }
        if(coords[length-1]){
            data.value = JSON.stringify(coords);
            process.disabled = false;
        }
        document.getElementById('id01').style.display='none';
    }
    else{
        alert("Please Make Grid!");
    }
}


//Сохранение параметров обрезки в JSON-нотацию
function saveToJson(){
    if(document.getElementById("grid")){
        coords[idTo] = setJSONProp();
        document.getElementById('id01').style.display='none';
        var length = document.getElementsByTagName("li").length;
        if(coords[length-1]){
            data.value = JSON.stringify(coords);
            process.disabled = false;
        }        
    }else{
        alert("Please Make Grid!");
    } 
}



//Возвращает параметры выделенной области
function setJSONProp(){
    var percX = image.offsetWidth/100;
    var percY = image.offsetHeight/100;
    var grid = document.getElementById("grid");
    var gridX = grid.offsetWidth/percX;
    var gridY = grid.offsetHeight/percY;
    var gridLeft = parseInt(grid.style.left)/percX;
    var gridTop = parseInt(grid.style.top)/percY;
    var col = document.getElementById("col").value;
    var row = document.getElementById("row").value;
    return {top:gridTop, left: gridLeft, width: gridX, height: gridY, col:col, row:row};
}



//Первоначальное состояние
function init(){
    var grid = document.getElementById("grid");
    var li_s = document.getElementsByTagName("li");
    var length = li_s.length;
    var pic = image.getElementsByTagName("img")[0];
    for(var i=0; i<length; i++){
        li_s[i].addEventListener(
            "click", 
            function(e){
                idTo =  e.target.getAttribute("idToProcess");
                var data = e.target.getAttribute("data");
                pic.setAttribute("src", data);
                if(document.getElementById("grid")){
                    image.removeChild(document.getElementById("grid"));
                }
                document.getElementById('id01').style.display='block';
        });
    }
}    


/*ОГОНЬ С ГРИДОМ*/   
function makeGrid(e){
//очистка сетки    
    if(document.getElementById("grid")){
        image.removeChild(document.getElementById("grid"));
    }
    isDown = true;
    var position = getOffsetRect(image);
    origin[0] = e.pageX-position.left;
    origin[1] = e.pageY-position.top;
    origPos[0] = e.pageX;
    origPos[1] = e.pageY;
//    
    var grid = document.createElement("div");
    grid.id = "grid";
    grid.style.position = "absolute";
    grid.style.top = origin[1]+"px";
    grid.style.left = origin[0]+"px";
    grid.style.width =  "1px";
    grid.style.height = "1px";
    grid.style.boxShadow = "0px 0px 0px 2px rgba(255,0,0,1)";
    grid.style.background = "rgba(255,200,200,0.2)";
    grid.style.display = "flex";
    grid.style.flexDirection = "column";
    image.appendChild(grid);
}

function resizeGrid(e){
    if(isDown && !selected){
        var grid = document.getElementById("grid");
        var newWidth =  e.pageX-origPos[0];
        var newHeight = e.pageY-origPos[1];
        grid.style.width =  newWidth+"px";
        grid.style.height = newHeight+"px";
    }
}

function fillGrid(){
    isDown = false;
    var col = document.getElementById("col").value;
    var row = document.getElementById("row").value;
    var grid = document.getElementById("grid");
    var gridW = grid.offsetWidth;
    var gridH = grid.offsetHeight;
        
    if(gridW>50 && gridH>50){    
        for(var i=0; i<row; i++){
            var elementContainer = document.createElement('div');
            elementContainer.style.width = "100%";
            elementContainer.style.height = `calc(100% / ${row})`;
            elementContainer.style.display = "flex";
            elementContainer.style.flexDirection = "row";
            elementContainer.style.justifyContent = "space-between";
            for(var j=0; j<col;j++){
                var gridElement = document.createElement('div');
                gridElement.style.width = `calc(100% / ${col} - 2px)`;
                gridElement.style.height = `calc(100% - 2px)`;
                gridElement.style.border = "1px solid transparent";
                gridElement.style.background = "rgba(10,10,230,0.2)";
                elementContainer.appendChild(gridElement);
            }
            grid.appendChild(elementContainer);
        }
    }
    grid.style.cursor = "pointer";
    grid.addEventListener("mousedown", mouseDownGrid );
    grid.addEventListener("mousemove", mouseMoveGrid );
    grid.addEventListener("mouseup", mouseUpGrid );
    //coords[idTo] = setJSONProp();
}

function mouseDownGrid(e){
    e.stopPropagation();
    selected = true;
    isDown = true;
    var grid = document.getElementById("grid");
    grid.style.cursor = "move";
    moveOrigin[0] = e.pageX-parseInt(grid.style.left);
    moveOrigin[1] = e.pageY-parseInt(grid.style.top);
}

function mouseMoveGrid(e){
    if(selected && isDown){
    var grid = document.getElementById("grid");
    var x = e.pageX-moveOrigin[0];
    var y = e.pageY-moveOrigin[1];
    grid.style.left = x+"px";
    grid.style.top = y+"px";
    }
}

function mouseUpGrid(e){
    e.stopPropagation();
    isDown = false;
    selected = false;
    var grid = document.getElementById("grid");
    grid.style.cursor = "pointer";
    //coords[idTo] = setJSONProp();
}



/*адидас с положение окна */
function getOffsetRect(elem) {
    // (1)
    var box = elem.getBoundingClientRect();

    // (2)
    var body = document.body;
    var docElem = document.documentElement;

    // (3)
    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft

    // (4)
    var clientTop = docElem.clientTop || body.clientTop || 0;
    var clientLeft = docElem.clientLeft || body.clientLeft || 0;

    // (5)
    var top  = box.top +  scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;

    return { top: Math.round(top), left: Math.round(left)};
}

};