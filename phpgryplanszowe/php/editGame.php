<?php 
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/editGame.js"></script>
    </head>
    <body>
        <div id="nav-placeholder"></div>

      <script>
      $(function(){
        $("#nav-placeholder").load("navbar.php");
      });
      </script>
        <h1 class="title">Edit game</h1>
        <?php
            if($_GET['editgame']=="success"){
                echo '<h4 class="info">Game edited.</h4>';
            }else if($_GET['editgame']=="error"){
                echo '<h4 class="error">Error: Game has not been edited.</h4>';
            }
        ?>
        <form class="formcreate" id="formGame" action="updateGame.php?gid=".$gameId.  accept-charset="utf-8" method="POST" enctype="multipart/form-data">
            <div>
                <label>Game Id</label>
                <input class="inputForm" type="text" id="gameId" name="gameId" value="" required readonly>
                <br><br>
                <label>Game Name</label>
                <input class="inputForm" type="text" id="gameName" name="gameName" value="" required>
                <br><br>
                <label>Game Min Players</label>
                <input class="inputForm" type="number" id="gameMinPlayers" name="gameMinPlayers" value="" required min=1 max=99>
                <br><br>
                <label>Game Max Players</label>
                <input class="inputForm" type="number" id="gameMaxPlayers" name="gameMaxPlayers" value="" required min=1 max=99>
                <br><br>
                <label>Game Min Age</label>
                <input class="inputForm" type="number" id="gameMinAge" name="gameMinAge" value="" required min=3 max=99>
                <br><br>
                <label>Game Max Age</label>
                <input class="inputForm" type="number" id="gameMaxAge" name="gameMaxAge" value="" required min=3 max=99>
                <br><br>
                <label>Game Image</label>
                <div id="gameimg" class="gameimg"></div>
                <button class="button" type="button" onclick="document.getElementById('changeGameImg').click()">Select file</button>
                <input class="fileInput" type="file" name="file" id="changeGameImg" title=" "><br>
                <br><br>
                <label>Game Description</label><br>
                <textarea class="inputForm" id="gameDescriptionText" name="gameDescriptionText" onkeyup="this.setAttribute('value', this.value);" value="" required></textarea>     
                <br><br>
                <label>Game Accepted</label>
                <select class="inputForm" id="gameAccepted" name="gameAccepted" >
                    <option value='0'>Don't accepted</option>
                    <option value='1'>Accept</option>
                    <option value='2'>Never used</option>
                </select>
                <br><br>
                <button class="button" type="button" onclick="goBack()">Cancel</button>
                <input class="button" type="submit" name="update" value="Save">
            </div><br>

        </form>
        <script> 
            $("#changeGameImg").change(function(e) {
            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                    img.setAttribute("class", "gameImage");
                }
                reader.readAsDataURL(file);
                $("#changeGameImg").after(img);
            }
            });
            
            <?php 
                include_once 'dbConnection.php'; 
                $gameId = $_GET["gid"];
                $sql = "SELECT * FROM game WHERE id_game=".$gameId."";
                        
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result)
            ?>

            setValues();
    
            function setValues() {

                document.getElementById("gameId").value = "<?php echo $row['id_game']; ?>";
                document.getElementById("gameName").value = "<?php echo $row['game_name']; ?>";
                document.getElementById("gameMinPlayers").value = "<?php echo $row['game_min_players']; ?>";
                document.getElementById("gameMaxPlayers").value = "<?php echo $row['game_max_players']; ?>";
                document.getElementById("gameMinAge").value = "<?php echo $row['game_min_age']; ?>";
                document.getElementById("gameMaxAge").value = "<?php echo $row['game_max_age']; ?>";
                document.getElementById("gameimg").innerHTML = "<?php 
                if($row['game_image']==1){
                    echo "<img src='../games/gameimg".$row['id_game'].".jpg?'".mt_rand().">";
                }else{
                    echo "<img src='../games/boardgamedefault.png'>";
                }
                ?>";
                var text = `<?php echo $row['game_description']; ?>`;
                // document.getElementById("gameDescriptionText").value = text.replace("<br />","");
                var regex = /<br\s*[\/]?>/gi;
                $("#gameDescriptionText").html(text.replace(regex,""));
                document.getElementById("gameAccepted").value = "<?php echo $row['game_accepted']; ?>";
            }
            
            document.getElementById('gameMinPlayers').addEventListener('change', checkValue);
            document.getElementById('gameMaxPlayers').addEventListener('change', checkValue);
            document.getElementById('gameMinAge').addEventListener('change', checkValue);
            document.getElementById('gameMaxAge').addEventListener('change', checkValue);
        </script>
    </body>
</html>