function goBack() {
    window.history.back();
}
function myFunction() {
    document.getElementById("myForm").submit();
}

function setGameValues(){
    var gameName = this.value;
    var gamesNumber = gamesArr.length;
    var i;
    if(gameName!=""){
        for(i=0;i<gamesNumber;i++){
            if(gamesArr[i][1]==gameName){
                document.getElementById('eventMinPlayers').value = gamesArr[i][2];
                document.getElementById('eventMaxPlayers').value = gamesArr[i][3];
                document.getElementById('eventMinAge').value = gamesArr[i][4];
                document.getElementById('eventMaxAge').value = gamesArr[i][5];
            }
        }
    }else{
        document.getElementById('eventMinPlayers').value = "";
        document.getElementById('eventMaxPlayers').value = "";
        document.getElementById('eventMinAge').value = "";
        document.getElementById('eventMaxAge').value = "";
    }
}

function checkValue(){
    var gameName = document.getElementById('eventGame').value;
    var gamesNumber = gamesArr.length;
    if(gameName!=""){
        for(i=0;i<gamesNumber;i++){
            if(gamesArr[i][1]==gameName){
                if(this.id=="eventMinPlayers" || this.id=="eventMaxPlayers"){
                    if(parseInt(this.value)<parseInt(gamesArr[i][2]) || parseInt(this.value)>parseInt(gamesArr[i][3])){
                        alert("value should be between "+ gamesArr[i][2] + " and "+ gamesArr[i][3]);
                        if(this.id=="eventMinPlayers"){
                            this.value=gamesArr[i][2];
                        }else{
                            this.value=gamesArr[i][3];
                        }
                    }else if(this.id=="eventMinPlayers" && parseInt(this.value)>parseInt(document.getElementById('eventMaxPlayers').value)){
                        alert("value can't be more than max players");
                        this.value=gamesArr[i][2];
                    }else if(this.id=="eventMaxPlayers" && parseInt(this.value)<parseInt(document.getElementById('eventMinPlayers').value)){
                        alert("value can't be less than min players");
                        this.value=gamesArr[i][3];
                    }
                }else if(this.id=="eventMinAge" || this.id=="eventMaxAge"){
                    if(parseInt(this.value)<parseInt(gamesArr[i][4]) || parseInt(this.value)>parseInt(gamesArr[i][5])){
                        alert("value should be between "+ gamesArr[i][4] + " and "+ gamesArr[i][5]);
                        if(this.id=="eventMinAge"){
                            this.value=gamesArr[i][4];
                        }else{
                            this.value=gamesArr[i][5];
                        }
                    }else if(this.id=="eventMinAge" && parseInt(this.value)>parseInt(document.getElementById('eventMaxAge').value)){
                        alert("value can't be more than max age");
                        this.value=gamesArr[i][4];
                    }else if(this.id=="eventMaxAge" && parseInt(this.value)<parseInt(document.getElementById('eventMinAge').value)){
                        alert("value can't be less than min age");
                        this.value=gamesArr[i][5];
                    }
                }
            }
        }
    }
}