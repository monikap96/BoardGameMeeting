function viewUser(uId){
    window.location.href = 'viewUser.php?uid='+uId+'';
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

function advancedSearch(){
    var filter = document.getElementById("search").value.toUpperCase();

    var input = [];
    input[1] = document.getElementById("userNameS").value.toUpperCase();
    input[2] = document.getElementById("roleS").value.toUpperCase();
    input[3] = document.getElementById("minRateS").value.toUpperCase();
    input[4] = document.getElementById("maxRateS").value.toUpperCase();
    var table, tr, td, i, j, txtValue;
    table = document.getElementById("usersTable");
    tr = table.getElementsByTagName("tr");
    
    for (i = 0; i < tr.length; i++) {
        for(j=1; j<4; j++){
            if(j==1){
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(input[j]) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                        break;
                    }
                }
            }else if(j==2){   
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase()==input[j] || input[j]=="") {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                        break;
                    }
                }   
            }else if(j==3 || j==4){
                td = tr[i].getElementsByTagName("td")[3];
                if(td){
                    txtValue = td.textContent || td.innerText;
                    if(input[3]!="" && input[4]!=""){
                        if(parseInt(input[3])<=parseInt(txtValue) && parseInt(input[4])>=parseInt(txtValue)){
                            tr[i].style.display = "";
                        }else{
                            tr[i].style.display = "none";
                            break;
                        }
                    }else if(input[3]!=""){
                        if(parseInt(input[3])<=parseInt(txtValue)){
                            tr[i].style.display = "";
                        }else{
                            tr[i].style.display = "none";
                            break;
                        }
                    }else if(input[4]!=""){
                        if(parseInt(input[4])>=parseInt(txtValue)){
                            tr[i].style.display = "";
                        }else{
                            tr[i].style.display = "none";
                            break;
                        }
                    }
                }
            }
        }
    }
    for (i = 0; i < tr.length; i++){
        if(tr[i].style.display == ""){
            for(j=1; j<4; j++){
                td = tr[i].getElementsByTagName("td")[j];
                if (td && filter!="") {
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
}

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("usersTable");
    switching = true;
    dir = "asc"; 
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if(n==1 || n==2){
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