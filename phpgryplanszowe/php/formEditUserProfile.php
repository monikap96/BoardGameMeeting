<?php
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>
    <body>
        <div id="nav-placeholder"></div>

      <script>
      $(function(){
        $("#nav-placeholder").load("navbar.php");
      });
      </script>
        <h1 id="userLogin" class="title"><?php echo $_SESSION['login'];?></h1>
        <form class="form" action="updateUserProfile.php" accept-charset="utf-8" method="POST">
            <img src="" id="avatar">
            <input type="image" value="Avatar" >
            <h5>About me</h5>
            <textarea id="aboutMe" name="aboutMe" cols="50" rows="10" placeholder="Describe yourself here..."></textarea>
            <br><br>
            <button onclick="goBack()" class="button" type="button">Cancel</button>
            <input class="button" type="submit" name="submit" value="Save">
        </form>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </body>
</html>