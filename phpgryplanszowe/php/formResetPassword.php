<?php
    session_start();
    include_once 'dbConnection.php';
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/formResetPassword.js"></script>
    </head>
    <body>
        <div id="nav-placeholder"></div>

        <script>
        $(function(){
        $("#nav-placeholder").load("navbar.php");
        });
        </script>
        <div class="divAll">
            <form id="formresetpass" name="formresetpass" class="form" action="dbResetPassword.php?vkey=<?php echo $_GET['vkey']?>" accept-charset="utf-8" method="POST" onsubmit="return check_pass(this);">
                <div class="div">
                    <div class="div withoutborder" id="divdiv1" style="width:90%;">
                        <input class="input" id="resetPass1" name="itisyourpriviet" type="password" minlength="8" value="" onkeyup="this.setAttribute('value', this.value);" required/>
                        <label class="label" id="password" >Password</label>
                    </div>
                    <div style="width:10%;">
                        <button id="showpass1" class="button" type="button" onclick="showPass()"><img id="iconEye1" src="../image/eye.svg" class="icon"/></button>
                    </div>
                </div>
                <br><br>
                <div class="div">
                    <div class="div withoutborder" id="divdiv2" style="width:90%;">
                        <input class="input" id="resetPass2" name="itisyourpriviet2" type="password" minlength="8" value="" onkeyup="this.setAttribute('value', this.value);" required/>
                        <label class="label" id="password2">Confirm password</label>
                    </div>
                    <div style="width:10%;">
                        <button id="showpass2" class="button" type="button" onclick="showPass2()"><img id="iconEye2" src="../image/eye.svg" class="icon"/></button>
                    </div>
                </div>
                <br><br>
                <input class="button" id="submitreg" type="submit" name="submit" value="Save"  >
            </form>
        </div>
    </body>
    <script>
        function check_pass() {
            if (document.getElementById('resetPass1').value != document.getElementById('resetPass2').value) {
                alert("Passwords are different");
                return false;
            } else {
                return true;
            }
        }
    </script>
</html>