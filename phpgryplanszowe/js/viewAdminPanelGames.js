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
function forLoggedUsers(){
    document.getElementById("forloggedUserCreateGame").remove();
}

function filterGames(){
    var val = [], td, i, j, txtValue;
    val[0] = document.getElementById("notYetAccepted").checked;
    val[1] = document.getElementById("accepted").checked;
    val[2] = document.getElementById("neverUsed").checked;
    var table = document.getElementById("gamesTable");
    var tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        tr[i].style.display = "";
    }
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if(td){
            txtValue = td.textContent || td.innerText;
            for(j=0;j<=2;j++){
                if(val[j]){
                    if(txtValue==j){
                        tr[i].style.display = "";
                        break;
                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
}

function searchGames() {
    var filter, table, tr, td, i, j, txtValue;
    filter = document.getElementById("searchGames").value.toUpperCase();
    table = document.getElementById("gamesTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        for(j=1; j<9 ; j++){
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
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