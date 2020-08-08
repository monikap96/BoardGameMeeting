function joinEvent(evId){
    window.location.href = 'joinEvent.php?evid='+evId+'';			
}
function leaveEvent(evId){
    window.location.href = 'leaveEvent.php?evid='+evId+'';			
}
function declineEvent(evId){
    window.location.href = 'declineEventInvitation.php?evid='+evId+'';			
}
function viewEvent(evId){
    window.location.href = 'viewEvent.php?evid='+evId+'';
}
function editEvent(evId){
    window.location.href = 'editEvent.php?evid='+evId+'';
}
function deleteEvent(evId){
    window.location.href = 'deleteEvent.php?evid='+evId+'';
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
    table = document.getElementById("eventsTable");
    switching = true;
    dir = "asc"; 
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if(n>=1 && n<=5){
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