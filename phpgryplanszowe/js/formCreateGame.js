function goBack() {
    window.history.back();
}

function checkValue(){
    var valueDoc = parseInt(this.value);
    var minPl = parseInt(document.getElementById('gameMinPlayers').value);
    var maxPl = parseInt(document.getElementById('gameMaxPlayers').value);
    var minAg = parseInt(document.getElementById('gameMinAge').value);
    var maxAg = parseInt(document.getElementById('gameMaxAge').value);
    if(this.id=="gameMinPlayers"){
        if(maxPl!=""){
            if(valueDoc>maxPl){
                alert("value should be between "+ valueDoc + " and "+ maxPl);
                this.value="";
            }
        }
    }else if (this.id=="gameMaxPlayers"){
        if(minPl!=""){
            if(valueDoc<minPl){
                alert("value should be between "+ valueDoc + " and "+ minPl);
                this.value="";
            }
        }
    }else if(this.id=="gameMinAge"){
        if(maxAg!=""){
            if(valueDoc>maxAg){
                alert("value should be between "+ valueDoc + " and "+ maxAg);
                this.value="";
            }
        }
    }else if (this.id=="gameMaxAge"){
        if(minAg!=""){
            if(valueDoc<minAg){
                alert("value should be between "+ valueDoc + " and "+ minAg);
                this.value="";
            }
        }
    } 
}