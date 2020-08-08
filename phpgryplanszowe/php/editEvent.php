<?php
	session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="../js/editEvent.js"></script>
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

            $games = "SELECT * FROM game";
				
            $result = mysqli_query($conn, $games);
            $options = "";
			$sqlusers = "SELECT * FROM `user`";
				
            $result2 = mysqli_query($conn, $sqlusers);
            $options2 = "";
            while($row2 = mysqli_fetch_array($result2)){
                $options2 = $options2."<option>".$row2['user_login']."</option>";
            }

            $eventId = $_GET["evid"];
            $sqlEvent = "SELECT * FROM eventt WHERE id_event LIKE '".$eventId."';";
			$resultEvent = mysqli_query($conn, $sqlEvent);
            $rowEvent = mysqli_fetch_assoc($resultEvent);
            $eventGameId = $rowEvent['event_game'];
            
            $eventInitiator = "SELECT id_user, user_login  FROM user WHERE id_user LIKE '".$rowEvent['event_initiator']."';";
            $resultInitiator = mysqli_query($conn, $eventInitiator);
            $rowInitiator = mysqli_fetch_assoc($resultInitiator);

            $eventGame = "SELECT id_game, game_name FROM game WHERE id_game LIKE '".$eventGameId."';";
            $resultEventGame = mysqli_query($conn, $eventGame);
            $rowEventGame = mysqli_fetch_assoc($resultEventGame);

        ?>

        <div class="divAll2"> 
        <h1 class="title">Edit event</h1>
        <?php
            if($_GET['editedEvent']=="success"){
                echo '<h4 class="info">Event edited.</h4>';
            }else if($_GET['editedEvent']=="error"){
                echo '<h4 class="error">Error: Event has not been edited.</h4>';
            }else if($_GET['editedEvent']=="noPermission"){
                echo '<h4 class="error">Error: You do not have permission.</h4>';
            }
        ?>
        <form id="formEvent" class="formcreate" action="updateEvent.php" accept-charset="utf-8" method="POST">
                <label class="label2">Id</label>
                <input class="inputForm" type="text" id="eventId" name="eventId" value="<?php echo $rowEvent['id_event']; ?>" readonly required><br><br>
                <label class="label2">Initiator</label>
                <input class="inputForm" type="text" id="eventInitiator" name="eventInitiator" value="<?php echo $rowInitiator['user_login']; ?>" readonly required>
                <br><br>
                <label class="label2">Place</label>
                <input class="inputForm" type="text" id="eventPlace" name="eventPlace" value="<?php echo $rowEvent['event_place'];?>" required>
                <br><br>
                <label id="labeldate" class="label2">Date</label>
                <input class="inputForm" type="date" id="eventDate" name="eventDate" value="<?php echo $rowEvent['event_date'];?>" required>
                <input class="inputForm" type="time" id="eventTime" name="eventTime" value="<?php echo $rowEvent['event_time'];?>" required>
                <br><br>
                <label class="label2">Game</label>
                <select class="inputForm" id="eventGame" name="eventGame"  value="<?php echo $rowEventGame['game_name'];?>">
                <?php 
                    $options = "<option></option>";
                    $gamesArray=array();
                    while($row = mysqli_fetch_array($result)){
                        $rowArray=array($row['id_game'],$row["game_name"],$row['game_min_players'],$row['game_max_players'],$row['game_min_age'],$row['game_max_age']);
                        array_push($gamesArray,  $rowArray);
                        if($row['game_name']==$rowEventGame['game_name']){
                            $options = $options."<option selected>".$row['game_name']."</option>";
                        }else{
                        $options = $options."<option>".$row['game_name']."</option>";
                        }
                    }
                    echo $options;
                ?>
                </select>
                <br><br>
                <label class="label2">Min Players</label>
                <input class="inputForm" type="number" id="eventMinPlayers" name="eventMinPlayers"  value="<?php echo $rowEvent['event_min_players'];?>">
                <br><br>
                <label class="label2">Max Players</label>
                <input class="inputForm" type="number" id="eventMaxPlayers" name="eventMaxPlayers" value="<?php echo $rowEvent['event_max_players'];?>">
                <br><br>
                <label class="label2">Min Age</label>
                <input class="inputForm" type="number" id="eventMinAge" name="eventMinAge"  value="<?php echo $rowEvent['event_min_age'];?>">
                <br><br>
                <label class="label2">Max Age</label>
                <input class="inputForm" type="number" id="eventMaxAge" name="eventMaxAge" value="<?php echo $rowEvent['event_max_age'];?>">
                <br><br>
                <label class="label2">Users</label>
                <?php 
                    echo "<br>";
                    $sql2 = "SELECT * FROM event_user WHERE id_event LIKE '".$rowEvent['id_event']."';";
					$result2 = mysqli_query($conn, $sql2);
					while($row2 = mysqli_fetch_assoc($result2)){
                        $sqlEventUsersName = "SELECT id_user, user_login  FROM user WHERE id_user LIKE '".$row2['id_user']."';";
                        $resultEventUsersName = mysqli_query($conn, $sqlEventUsersName);
                        while($rowEventUsersName = mysqli_fetch_assoc($resultEventUsersName)){
                            echo $rowEventUsersName["user_login"]."<br>";
                        }
                    }
                ?>
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