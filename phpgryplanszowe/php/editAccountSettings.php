<?php
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/editAccountSettings.js"></script>
    </head>
    <body>
        <div id="nav-placeholder"></div>
  
        <script>
        $(function(){
          $("#nav-placeholder").load("navbar.php");
        });
        </script>
        
        <?php
            include_once 'dbConnection.php';
            $loginValue = $_SESSION['login'];
            $sql = "SELECT * FROM user WHERE user_login LIKE '".$loginValue."';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $userEmail = $row['user_email'];

            $actualUserId = $_SESSION['id'];
        ?>
        <?php
            if($_GET['changeDescr']=="success"){
                echo '<h4 class="info">Descrioption changed.</h4>';
            }else if($_GET['changeDescr']=="error"){
                echo '<h4 class="error">Error: Description has not been changed.</h4>';
            }
        ?>
    <h1 class="title">Account settings</h1>
    <div id="accountSettings">

        <?php
            if($_GET['changeEmail']=="success"){
                echo '<h4 class="info">Email changed.</h4>';
            }else if($_GET['changeEmail']=="error"){
                echo '<h4 class="error">Error: Email has not been changed.</h4>';
            }else if($_GET['changePass']=="success"){
                echo '<h4 class="info">Password changed.</h4>';
            }else if($_GET['changePass']=="error"){
                echo '<h4 class="error">Error: Password has not been changed.</h4>';
            }else if($_GET['changePass']=="incorrectPass"){
                echo '<h4 class="error">Error: Incorrect password.</h4>';
            }else if($_GET['avatarchanged']=="success"){
                echo '<h4 class="info">Avatar changed.</h4>';
            }else if($_GET['avatarchanged']=="fileTooBig"){
                echo '<h4 class="error">Error: File is too big.</h4>';
            }else if($_GET['avatarchanged']=="error"){
                echo '<h4 class="error">Error: Avatar has not been changed.</h4>';
            }else if($_GET['avatarchanged']=="wrongType"){
                echo '<h4 class="error">Error: Wrong type of file.</h4>';
            }
        ?>

        <table class="table"> 
            <tr>
                <div class="dframe">
                    <form id="formmail" class="formmsettings" action="updateEmail.php" accept-charset="utf-8" method="POST">
                        <h2>Change address e-mail</h2>
                        <label>Actual address: <?php echo $userEmail;?></laber><br><br>
                        <label>New address</laber><br>
                        <input class="inputForm" type="email" id="email" name="thisIsMyNewMail"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required ><br><br>
                        <input class="button" type="submit" name="submit" value="Save">
                    </form>
                </div>
            </tr>
            <tr>
                <div class="dframe">
                    <form id="formpass" class="formmsettings" action="updatePassword.php" accept-charset="utf-8" method="POST" onsubmit="return check_pass(this);">
                        <h2>Change password</h2>
                        <label>Old password</laber><br>
                        <input class="inputForm" type="password" id="oldPassword" name="oldPassword" required><br><br>
                        <label>New password</laber><br>
                        <input class="inputForm" type="password" id="newPassword" name="thisIsMyNewPasscode" required><br><br>
                        <label>Confirm new password</laber><br>
                        <input class="inputForm" type="password" id="newPassword2" required><br><br>
                        <input class="button" type="submit" name="submit" value="Save">
                    </form>
                </div>
            </tr>
            <tr>
                <div class="dframe profileUserImg">
                    <h2>Change Avatar</h2> 
                    <?php
                        if($row['user_avatar']==1){
                            echo "<img id='avatar' src='../avatars/profile".$actualUserId.".jpg?'".mt_rand().">";
                        }else{
                            echo "<img id='avatar' src='../avatars/profiledefault.jpg'>";
                        }
                    ?>
                    <form id="formavatar" class="formmsettings" action="updateAvatar.php" method="POST" enctype="multipart/form-data">
                        <button class="button" type="button" onclick="document.getElementById('changeAvatar').click()">Select file</button>
                        <input class="fileInput" type="file" name="file" id="changeAvatar"><br>
                        <input class="button" type="submit" name="submit" value="Save">
                    </form>
                </div>
            </tr>
            <tr>
                <div class="dframe">
                    <h3>About me</h3>
                    <form id="formDescription" class="formmsettings" action="updateUserProfile.php" method="POST" accept-charset="utf-8">
                        <textarea id="aboutMe" name="aboutMe" cols="50" rows="10" value="" onkeyup="this.setAttribute('value', this.value);"></textarea>
                    <br><br>
                        <input class="button" type="submit" name="submit" value="Save">
                    </form>
                </div>
            </tr>
        </table> 
    </div> 
    <script>
        $("#changeAvatar").change(function(e) {
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                    img.setAttribute("class", "gameImage");
                }
                reader.readAsDataURL(file);
                $("#changeAvatar").after(img);
            }
            });

        setValues();
       
        function setValues() {
            document.getElementById("aboutMe").value = `<?php echo $row['user_description']; ?>`;
        }
    </script>
    </body> 
</html>