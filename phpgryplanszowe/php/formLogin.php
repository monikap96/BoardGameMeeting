<?php
    session_start();
    include_once 'dbConnection.php';
    $myId = $_SESSION['id'];
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>
    <body style=" background-image: url('../image/backgr4.jpg');
    background-attachment: fixed;
    background-size: cover;">
        <div id="nav-placeholder"></div>

      <script>
      $(function(){
        $("#nav-placeholder").load("navbar.php");
      });
      </script>
        <h1 class="title">Login</h1>
        <div class="divAll" id="loginDiv">
            <?php
                if($_GET['error']=="invalidLoginOrPass"){
                    echo '<h4 class="error" >Invalid login or password.</h4>';
                }
            ?>
            <form id="formlogin" class="form" action="dbLogin.php" method="POST">
                <div class="div">
                    <input class="input" id="inUser" name="ivegotyourloginmydear" type="text" value="" onkeyup="this.setAttribute('value', this.value);" required>
                    <label class="label" id="username">Username</label>
                </div>
                <br><br>
                <div class="div">
                    <div style="width:90%;" class="div withoutborder" id="divdiv">
                        <input class="input" id="inPass" name="andyourpasswordtoo" type="password" value="" onkeyup="this.setAttribute('value', this.value);" required>
                        <label class="label" id="password">Password</label>
                    </div>
                    <div style="width:10%;">
                        <button id="showpass" class="button" type="button" onclick="showPass()"><img id="iconEye" src="../image/eye.svg" class="icon"/></button>
                    </div>
                </div>
                <br>
                <input class="button" type="submit" name="submit" value="Login"><br>
                <a id="questionforgotpassword" class="link" href="formPasswordRecovery.php">Forgot password?</a><br>
            </form>
        </div>

        <script>
            function showPass(){
                var eye="../image/eye.svg";
                var crossedEye="../image/eye2.svg";
                var passtype = document.getElementById("inPass").type;
                if(passtype=="password"){
                    document.getElementById("inPass").type="text";
                    document.getElementById("iconEye").src=crossedEye;
                }else{
                    document.getElementById("inPass").type="password";
                    document.getElementById("iconEye").src=eye;
                }
            }
        </script>
    </body>
</html>
