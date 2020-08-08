function viewGame(gId){
    window.location.href = 'viewGame.php?gid='+gId+'';
}
function editGame(gId){
    window.location.href = 'editGame.php?gid='+gId+'';
}
function deleteGame(gId){
    var conf = confirm('Are you sure want to delete this game?');
    if(conf){
        window.location.href = 'deleteGame.php?gid='+gId+'';
    }
}	

function advancedDiv(){
    var valOfButton = document.getElementById("advancedButton").value;
    if(valOfButton=="advanced search"){
        document.getElementById("advancedButton").value="hide advanced search";
        document.getElementById("advancedSearch").style.display="";
    }else if(valOfButton=="hide advanced search"){
        document.getElementById("advancedButton").value="advanced search";
        document.getElementById("advancedSearch").style.display="none";
    }
}
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("gamesTable");
    switching = true;
    dir = "asc"; 
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if(n==1){
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }else{
                if (dir == "asc") {
                    if (Number(x.innerHTML) > Number(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }else if (dir == "desc"){
                    if (Number(x.innerHTML) < Number(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;      
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}