function check_pass() {
    if (document.getElementById('newPassword').value != document.getElementById('newPassword2').value) {
        alert("Passwords are different");
        return false;
    } else {
        return true;
    }
}
