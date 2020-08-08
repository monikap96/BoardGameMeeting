<?php
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/formCreateEvent.js"></script>
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
			$games = "SELECT * FROM game WHERE game_accepted='1' OR (game_accepted='2' AND game_created_by='".$_SESSION['id']."');";
				
            $result = mysqli_query($conn, $games);
            $options = "<option></option>";
            $gamesArray=array();
            while($row = mysqli_fetch_array($result)){
                $rowArray=array($row['id_game'],$row["game_name"],$row['game_min_players'],$row['game_max_players'],$row['game_min_age'],$row['game_max_age']);
                array_push($gamesArray,  $rowArray);
                $options = $options."<option class='breakWord' style='max-width: 200px;' value='".$row['game_name']."'>".$row['game_name']."</option>";
                
            }
            $sqlusers = "SELECT * FROM `user`";
				
            $result2 = mysqli_query($conn, $sqlusers);
            $options2 = "";
            while($row2 = mysqli_fetch_array($result2)){
                if($row2['user_login'] != $_SESSION['login']){
                    $options2 = $options2."<option>".$row2['user_login']."</option>";
                }
            }
        ?>

        <div class="divAll2"> 
            <h1 class="title">Create event</h1>
            <?php
                if($_GET['createEvent']=="success"){
                    echo '<h4 class="info">Event created.</h4>';
                }else if($_GET['error']=="addUsersFailed"){
                    echo '<h4 class="error">Error: Users has not been added to event.</h4>';
                }else if($_GET['error']=="createEventFailed"){
                    echo '<h4 class="error">Error: Event has not been created.</h4>';
                }
            ?>
            <form id="formCreate" class="formcreate" action="dbCreateEvent.php" accept-charset="utf-8" method="POST">
                <label class="label2">Initiator</label>
                <input class="inputForm" type="text" id="eventInitiator" name="eventInitiator" value="<?php echo $_SESSION['login']; ?>" readonly required>
                <br><br>
                <label class="label2">Place</label>
                <input class="inputForm" type="text" id="eventPlace" name="eventPlace" required>
                <br><br>
                <label id="labeldate" class="label2">Date</label>
                <input class="inputForm" type="date" id="eventDate" name="eventDate" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                <input class="inputForm" type="time" id="eventTime" name="eventTime" value="<?php echo date('H:i'); ?>" required>
                <br><br>
                <label class="label2">Game</label>
                <select class="inputForm" id="eventGame" name="eventGame" >
                    <?php echo $options;?></option>
                </select>
                <br><br>
                <label class="label2">Min Players</label>
                <input class="inputForm" type="number" id="eventMinPlayers" name="eventMinPlayers">
                <br><br>
                <label class="label2">Max Players</label>
                <input class="inputForm" type="number" id="eventMaxPlayers" name="eventMaxPlayers">
                <br><br>
                <label class="label2">Min Age</label>
                <input class="inputForm" type="number" id="eventMinAge" name="eventMinAge">
                <br><br>
                <label class="label2">Max Age</label>
                <input class="inputForm" type="number" id="eventMaxAge" name="eventMaxAge">
                <br><br>
                <label class="label2">Users</label><br>
                <label class="optionUser"><?php echo $_SESSION['login']?></label><br> 
                <select class="inputForm scrollbar optionUser" id="users" name="users[]" multiple>
                    <?php echo $options2;?></option>
                </select>
                <br><br>
                <button class="button" type="button" onclick="goBack()">Cancel</button>
                <input class="button" type="submit" name="submit" value="Save">
            </form>
        </div>

        <script> 
            document.getElementById('eventGame').addEventListener('change', setGameValues);

            var gamesArr = <?php echo json_encode($gamesArray); ?>;

            document.getElementById('eventMinPlayers').addEventListener('change', checkValue);
            document.getElementById('eventMaxPlayers').addEventListener('change', checkValue);
            document.getElementById('eventMinAge').addEventListener('change', checkValue);
            document.getElementById('eventMaxAge').addEventListener('change', checkValue);
        </script>
    </body>
</html>