<?php
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/formCreateGame.js"></script>
    </head>
    <body>
        <div id="nav-placeholder"></div>

      <script>
      $(function(){
        $("#nav-placeholder").load("navbar.php");
      });
      </script>
        <h1 class="title">Create game</h1>
        <form class="formcreate" id="formGame" action="dbCreateGame.php" accept-charset="utf-8" method="POST" enctype="multipart/form-data">
            <div>
                <label>Game Name</label>
                <input class="inputForm" type="text" id="gameName" name="gameName" required>
                <br><br>
                <label>Game Min Players</label>
                <input class="inputForm" type="number" id="gameMinPlayers" name="gameMinPlayers" required min=1 max=99>
                <br><br>
                <label>Game Max Players</label>
                <input class="inputForm" type="number" id="gameMaxPlayers" name="gameMaxPlayers" required min=1 max=99>
                <br><br>
                <label>Game Min Age</label>
                <input class="inputForm" type="number" id="gameMinAge" name="gameMinAge" required min=3 max=99>
                <br><br>
                <label>Game Max Age</label>
                <input class="inputForm" type="number" id="gameMaxAge" name="gameMaxAge" required min=3 max=99>
                <br><br>
                <label>Game Image</label>
                <button class="button" type="button" onclick="document.getElementById('changeGameImage').click()">Select file</button>
                <input class="gameImage fileInput" type="file" name="file" id="changeGameImage" ><br>
                <br><br>
                <label>Game Description</label><br>
                <textarea class="inputForm scrollbar" id="gameDescriptionText" name="gameDescriptionText" required></textarea>     
                <br><br>
                <button class="button" type="button" onclick="goBack()">Cancel</button>
                <input class="button" type="submit" name="submit" value="Save">
            </div><br>
        </form>
        <script> 
            $("#changeGameImage").change(function(e) {
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                    img.setAttribute("class", "gameImage");
                }
                reader.readAsDataURL(file);
                $("#changeGameImage").after(img);
            }
            });

            document.getElementById('gameMinPlayers').addEventListener('change', checkValue);
            document.getElementById('gameMaxPlayers').addEventListener('change', checkValue);
            document.getElementById('gameMinAge').addEventListener('change', checkValue);
            document.getElementById('gameMaxAge').addEventListener('change', checkValue);
        </script>
    </body>
</html>