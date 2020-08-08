<?php
    session_start();
    include_once 'dbConnection.php';
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/formRegister.js"></script>
    </head>
    <body style=" background-image: url('../image/backgr5.jpg');
    background-attachment: fixed;
    background-size: cover;">
        <div id="nav-placeholder"></div>

    <script>
    $(function(){
    $("#nav-placeholder").load("navbar.php");
    });
    </script>

    <?php
        $sqlUsers = "SELECT * FROM `user`";
        $resultUsers = mysqli_query($conn, $sqlUsers);
        $usernames[] ="";
        $numberofres="";
        $numberofres = mysqli_num_rows($resultUsers);
        while($rowUsers = mysqli_fetch_array($resultUsers)){
            $usernames[] = $rowUsers['user_login'];
        }
        echo '<script> var usernamesarray = '.json_encode($usernames).';</script>';
        echo '<script> var numberofrows = '.json_encode($numberofres).';</script>';
    
    ?>
        <h1 class="title">Registration</h1>
        <div class="divAll" id="registerDiv">
        <form id="formregister" name="formregister" class="form" action="dbRegister.php" accept-charset="utf-8" method="POST" onsubmit="return check_pass(this);">
            <div class="div">
                <div class="div withoutborder" id="divdiv3" style="width:90%; padding: 8px 0px;">
                    <input class="input" id="inUser" name="thereisyournick" type="text" minlength="6" value="" onkeyup="this.setAttribute('value', this.value);" required/>
                    <label class="label" id="username">Username</label> 
                </div>
                <div class="div withoutborder" id="divdiv4" style="width:10%;">
                    <img src="../image/przerzo.png" id="isLoginExist" class="icon">
                </div>
            </div><br>
            <br><br>
            <div class="div">
                <input class="input" id="inEmail" name="mailaddress" type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" onkeyup="this.setAttribute('value', this.value);" required/>
                <label class="label" id="mailaddress">E-mail address</label>
            </div>
            <br><br>
            <div class="div">
                <div class="div withoutborder" id="divdiv1" style="width:90%;">
                    <input class="input" id="inPass1" name="itisyourpriviet" type="password" minlength="8" value="" onkeyup="this.setAttribute('value', this.value);" required/>
                    <label class="label" id="password" >Password</label>
                </div>
                <div style="width:10%;">
                    <button id="showpass1" class="button" type="button" onclick="showPass()"><img id="iconEye1" src="../image/eye.svg" class="icon"/></button>
                </div>
            </div>
            <br><br>
            <div class="div">
                <div class="div withoutborder" id="divdiv2" style="width:90%;">
                    <input class="input" id="inPass2" name="itisyourpriviet2" type="password" minlength="8" value="" onkeyup="this.setAttribute('value', this.value);" required/>
                    <label class="label" id="password2">Confirm password</label>
                </div>
                <div style="width:10%;">
                    <button id="showpass2" class="button" type="button" onclick="showPass2()"><img id="iconEye2" src="../image/eye.svg" class="icon"/></button>
                </div>
            </div>
            <br><br>
            <div class="div">
                <input class="input" id="inbirthDate" name="birthDate" type="date" min="1920-01-01" max="2019-12-31" required />
                <label class="label" id="birthDate">Birthdate</label>
            </div>
            <br><br>
            <button onclick="goBack()" class="button">Cancel</button> 
            <input class="button" id="submitreg" type="submit" name="submit" value="Create an account"  >
        </form>
    </div>
        <script>
            document.getElementById("inUser").addEventListener('change', checkIfUsernameExist);
            document.getElementById("inPass2").addEventListener('change', checkIfPassAreCorrect);
        </script>
    </body>
</html>