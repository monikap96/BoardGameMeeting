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
        <h1 class="title">Password Recovery</h1>
        <form id="formpassword" class="form" action="dbPasswordRecovery.php" method="POST">
            <p>If you don't remember your password:</p>
            <label id="emailLabel">Enter your address e-mail</label>
            <input class="inputForm" type="email" id="emailaddress" name="emailaddress" required>
            <br><br>
            <button class="button" type="button" onclick="goBack()">Cancel</button>
            <input class="button" type="submit" name="submit" value="Send">
        </form>
        <script>
            function findemailaddress(){
                var email= document.getElementById("emailaddress").value;
                console.log(email);
            }   
          
            function goBack() {
                window.history.back();
            }
        </script>
    </body>
</html>