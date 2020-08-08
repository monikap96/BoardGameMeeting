function checkIfUsernameExist(){
    if(this.value!=""){
        var isExist = false;
        for(var i=1; i<=numberofrows; i++){
            if(usernamesarray[i]==this.value){
                isExist=true;
            }
        }
        if(isExist==false){
            document.getElementById("isLoginExist").src = "../image/check.svg";
        }else{
            document.getElementById("isLoginExist").src = "../image/times.svg";
        }
    }
}
function checkIfPassAreCorrect(){
    if(this.value!=""){
        if(document.getElementById("inPass1").value != this.value){
            document.getElementById("inPass2").setCustomValidity("wrong password");
        }else{
            document.getElementById("inPass2").setCustomValidity("");
        }
    }
}
function check_pass() {
    if (document.getElementById('inPass1').value != document.getElementById('inPass2').value) {
        alert("Passwords are different");
        return false;
    } else {
        return true;
    }
}

function showPass(){
    var eye="../image/eye.svg";
    var crossedEye="../image/eye2.svg";
    var passtype = document.getElementById("inPass1").type;
    if(passtype=="password"){
        document.getElementById("inPass1").type="text";
        document.getElementById("iconEye1").src=crossedEye;
    }else{
        document.getElementById("inPass1").type="password";
        document.getElementById("iconEye1").src=eye;
    }
}
function showPass2(){
    var eye="../image/eye.svg";
    var crossedEye="../image/eye2.svg";
    var passtype = document.getElementById("inPass2").type;
    if(passtype=="password"){
        document.getElementById("inPass2").type="text";
        document.getElementById("iconEye2").src=crossedEye;
    }else{
        document.getElementById("inPass2").type="password";
        document.getElementById("iconEye2").src=eye;
    }
}

function goBack() {
    window.history.back();
}