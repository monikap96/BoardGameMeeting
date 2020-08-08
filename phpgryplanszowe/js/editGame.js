function checkValue(){
    var valueDoc = parseInt(this.value);
    var minPl = parseInt(document.getElementById('gameMinPlayers').value);
    var maxPl = parseInt(document.getElementById('gameMaxPlayers').value);
    var minAg = parseInt(document.getElementById('gameMinAge').value);
    var maxAg = parseInt(document.getElementById('gameMaxAge').value);
    if(this.id=="gameMinPlayers"){
        if(maxPl!=""){
            if(valueDoc>maxPl){
                alert("value can't be more than max players");
                this.value="";
            }
        }
    }else if (this.id=="gameMaxPlayers"){
        if(minPl!=""){
            if(valueDoc<minPl){
                alert("value can't be less than min players");
                this.value="";
            }
        }
    }else if(this.id=="gameMinAge"){
        if(maxAg!=""){
            if(valueDoc>maxAg){
                alert("value can't be more than max age");
                this.value="";
            }
        }
    }else if (this.id=="gameMaxAge"){
        if(minAg!=""){
            if(valueDoc<minAg){
                alert("value can't be less than min age");
                this.value="";
            }
        }
    } 
}


function goBack() {
    window.history.back();
}
