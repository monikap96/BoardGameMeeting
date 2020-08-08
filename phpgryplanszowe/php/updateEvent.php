<?php
    session_start();
    include_once 'dbConnection.php';
    
    if(isset($_POST['submit'])){
        $idEvent = $_POST['eventId'];
        $eventInitiator = $_POST['eventInitiator'];
        $eventPlace = $_POST['eventPlace'];
        $eventDate = $_POST['eventDate'];
        $eventTime = $_POST['eventTime'];
        $eventGame = $_POST['eventGame'];
        $eventMinPlayers = $_POST['eventMinPlayers'];
        $eventMaxPlayers = $_POST['eventMaxPlayers'];
        $eventMinAge = $_POST['eventMinAge'];
        $eventMaxAge = $_POST['eventMaxAge'];
        
        $sqlIdGame = "SELECT * FROM game WHERE game_name LIKE '".$eventGame."';";
        $resultIdGame = mysqli_query($conn, $sqlIdGame);
        $row3 = mysqli_fetch_assoc($resultIdGame);
        $idGame = $row3['id_game'];

        $actualUser = $_SESSION['login'];
        $sqlIdUser = "SELECT * FROM user WHERE user_login LIKE '".$actualUser."';";
        $resultIdUser = mysqli_query($conn, $sqlIdUser);
        $rowIdUser = mysqli_fetch_assoc($resultIdUser);
        $idInitiator = $rowIdUser['id_user'];
        $role = $rowIdUser['user_role'];

        $event = "SELECT * FROM eventt WHERE id_event='".$idEvent."';";
        $resultEvent = mysqli_query($conn, $event);
        
        while($rowEvent = mysqli_fetch_assoc($resultEvent)){
            $date = date("Y-m-d");
            $time =  date("H:i:s");
            $eventSavedDate = $rowEvent['event_date'];
            $eventSavedTime = $rowEvent['event_time'];
            
            if(($eventSavedDate>$date) || ($eventSavedDate==$date && $eventSavedTime>$time) || ($role=="administrator") || ($role=="admin")){
            
                if($eventPlace != $rowEvent['event_place'] || $eventDate != $rowEvent['event_date'] || $eventTime != $rowEvent['event_time']
                || $eventGame != $rowEvent['event_game'] || $eventMinPlayers != $rowEvent['event_min_players'] 
                || $eventMaxPlayers != $rowEvent['event_max_players'] || $eventMinAge != $rowEvent['event_min_age'] || $eventMaxAge != $rowEvent['event_max_age']){
                    $contents = "Event number ".$idEvent." has changed: ";
        
                    if($eventPlace != $rowEvent['event_place']){
                        $contents.="<br>Place: ".$eventPlace;
                    }
                    if($eventDate != $rowEvent['event_date'] || $eventTime != $rowEvent['event_time']){
                        $contents.="<br>Date and time: ".$eventDate."  ".$eventTime;
                    }
                    if($eventGame != $rowEvent['event_game']){
                        $contents.="<br>Game: ".$eventGame;
                    }
                    if($eventMinPlayers != $rowEvent['event_min_players'] || $eventMaxPlayers != $rowEvent['event_max_players']){
                        $contents.="<br>Min and max players: ".$eventMinPlayers."  ".$eventMaxPlayers;
                    }
                    if($eventMinAge != $rowEvent['event_min_age'] || $eventMaxAge != $rowEvent['event_max_age']){
                        $contents.="<br>Min and max age: ".$eventMinAge."  ".$eventMaxAge;
                    }
                }
                
                if($actualUser == $eventInitiator || $role=="administrator" || $role=="admin"){
                    $sql = "UPDATE eventt SET event_place='$eventPlace', event_date='$eventDate', event_time='$eventTime', event_min_players='$eventMinPlayers', event_max_players='$eventMaxPlayers', event_min_age='$eventMinAge', event_max_age='$eventMaxAge', event_game='$idGame' WHERE id_event='$idEvent';";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $sqlIdUsers = "SELECT * FROM event_user WHERE id_event='".$idEvent."';";
                        $resultIdUsers = mysqli_query($conn, $sqlIdUsers);
                        while($rowIdUsers = mysqli_fetch_assoc($resultIdUsers)){
                            $user = $rowIdUsers['id_user'];
                            if($user!=$rowIdUsers['event_initiator']){
                                $notification = "INSERT INTO notificationn (id_user, id_event, notif_read, notif_contents) VALUES ('$user', '$idEvent', 0, '$contents');";
                                $resultnotif = mysqli_query($conn, $notification);
                            }
                        }
                        header("Location: viewEventList.php?editedEvent=success");
                    }else{
                        header("Location: viewEventList.php?editedEvent=error");
                    }
                }else{
                    header("Location: viewEventList.php?error=noPermission");
                } 
            
            }else{
                header("Location: viewEventList.php?error=outOfTime");
            }
        }
        
    }
?>