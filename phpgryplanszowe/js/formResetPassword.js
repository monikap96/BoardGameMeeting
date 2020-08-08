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