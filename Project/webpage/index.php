<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input OutPut 25562　すごい！！！</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <p id="score"></p>

    <div class="wrapper">
        <div id="colorVals">

                <div class="value">
                    <p id="R"></p>
                </div>

                <div class="value">
                    <p id="G"></p>
                </div>
                
                <div class="value">
                    <p id="B"></p>
                </div>
                
            </div>
        </div>
        <script>
            let colorVals = document.getElementById('colorVals');
            let bod = document.body;
            
            let rDisplay = document.getElementById('R');
            let gDisplay = document.getElementById('G');
            let bDisplay = document.getElementById('B');
            let scoreDisplay = document.getElementById('score');
            let r,g,b,colR,colG,colB,score,oldR,oldG,oldB,oldColR,oldColG,oldColB,colorArray,rgbArray,colorString,rgbString;
            let initialized = false;
            
            let reqCount = 0;

function Setup(){
    
    SetValues();
    
    oldR = r;
    oldG = g;
    oldB = b;
    
    oldColR = colR;
    oldColG = colG;
    oldColB = colB;
    
    console.log("rgb(" + colR + "," + colG + "," + colB + ")");
    
    CalcScore();
    
    scoreDisplay.innerHTML = score;
    
    if(r != "" && r != null && g != "" && g != null && b != "" && b != null && colR != "" && colR != null && colG != "" && colG != null && colB != "" && colB != null){
        UpdateColor();
        UpdateRGB();
    }
    
    init = setInterval(() => {
        Run();
    }, 1000/60);

    setInterval(() => {
        Run();
    }, 1000/30);

}

function Run(){


    SetValues();
    if(r != oldR || G != oldG || b != oldB){
        oldR = r;
        oldG = g;
        oldB = b;
        if(r != "" && r != null && g != "" && g != null && b != "" && b != null){
            UpdateRGB();
            CalcScore();
            scoreDisplay.innerHTML = score;
        }
    }
    
    if(colR != oldColR || oldG != oldColG || oldB != oldColB){
        console.log("R: " + colR + "| old: " + oldColR);
        console.log("G: " + colG + "| old: " + oldColG);
        console.log("B: " + colB + "| old: " + oldColB);
        oldColR = colR;
        oldColG = colG;
        oldColB = colB;        
        if(colR != "" && colR != null && colG != "" && colG != null && colB != "" && colB != null){
            UpdateColor();
            CalcScore();
            scoreDisplay.innerHTML = score;
        }
    }
}


function SetValues(){
    ajaxVars("colorVals.json");
    if (colorString != null) 
        colorArray = JSON.parse(colorString);
    
    if (colorArray != undefined){
        colR = colorArray['r'];
        colG = colorArray['g'];
        colB = colorArray['b'];
    }

    ajaxVars("rgbValues.json");
    if (rgbString != null) 
        rgbArray = JSON.parse(rgbString);
    
    if (rgbArray != undefined){
        r = rgbArray['r'];
        g = rgbArray['g'];
        b = rgbArray['b'];
    }

    if(rgbArray != undefined && colorArray != undefined && !initialized){
        initialized = true;
        clearInterval(init);
    }
    
    rDisplay.innerHTML = Math.floor(r);
    gDisplay.innerHTML = Math.floor(g);
    bDisplay.innerHTML = Math.floor(b);
}


function UpdateColor(){
    bod.style.setProperty('background-color', "rgb(" + colR + "," + colG + "," + colB + ")");
}

function UpdateRGB(){
    colorVals.style.setProperty('background-color', "rgb(" + r + "," + g + "," + b + ")");
}

function CalcScore(){
    let sr,sg,sb;
    
    sr = r - colR;
    sg = g - colG;
    sb = b - colB;
    
    if(sr < 0)
    sr = -sr;
    
    if(sg < 0)
    sg = -sg;
    
    if(sb < 0)
    sb = -sb;
    
    sr = 255 - sr;
    sg = 255 - sg;
    sb = 255 - sb;
    
    score = Math.floor(sr+sg+sb) + " / " + (255 * 3);
    
    scoreDisplay.style.setProperty('color', "rgb(" + (255 - colR) + "," + (255 - colG) + "," + (255 - colB) + ")");
}

function ajaxVars(path){
    
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(path == "rgbValues.json"){
                rgbString = this.responseText;
            }
            else if(path == "colorVals.json")
            {
                colorString = this.responseText;
            }
        }
    };
    reqCount++;
    xhttp.open("GET", path + "?cache=" + reqCount, true);
    xhttp.send();
   
}


Setup();
</script>
    
</body>
</html>