<?php
    session_start();
    include_once 'dbConnection.php';
    $idInitiator = $_SESSION['id'];
    if(isset($_POST['submit'])){
        $eventPlace = $_POST['eventPlace'];
        $eventDate = $_POST['eventDate'];
        $eventTime = $_POST['eventTime'];
        $eventGame = $_POST['eventGame'];
        $eventMinPlayers = $_POST['eventMinPlayers'];
        $eventMaxPlayers = $_POST['eventMaxPlayers'];
        $eventMinAge = $_POST['eventMinAge'];
        $eventMaxAge = $_POST['eventMaxAge'];
        $users = $_POST['users'];
        
        $sqlIdGame = "SELECT * FROM game WHERE game_name LIKE '".$eventGame."';";
        $resultIdGame = mysqli_query($conn, $sqlIdGame);
        while($rowIdGame = mysqli_fetch_assoc($resultIdGame)){
            $idGame = $rowIdGame['id_game'];
            $isAccepted = $rowIdGame['game_accepted'];
            $creator = $rowIdGame['game_created_by'];

            if($isAccepted ==1 || ($isAccepted==2 && $creator==$idInitiator)){
                if($isAccepted==2 && $creator==$idInitiator){
                    $update = "UPDATE game SET game_accepted='0' WHERE id_game='$idGame';";
                    $resultUpdate = mysqli_query($conn, $update);
                }
                $sql = "INSERT INTO eventt (event_place, event_date, event_time, event_min_players, event_max_players, event_min_age, event_max_age, event_game, event_initiator)
                VALUES ('$eventPlace', '$eventDate', '$eventTime', '$eventMinPlayers', '$eventMaxPlayers', '$eventMinAge', '$eventMaxAge', '$idGame', '$idInitiator');";
                
                $result = mysqli_query($conn, $sql);
                
                if($result){
                    $idEvent = mysqli_insert_id($conn);
                    if($_POST['users']){
                        foreach($_POST['users'] as $users) {
                            $sqlIdUser = "SELECT * FROM user WHERE user_login LIKE '".$users."';";
                            $resultIdUser = mysqli_query($conn, $sqlIdUser);
                            $row4 = mysqli_fetch_assoc($resultIdUser);
                            $idUser = $row4['id_user'];
            
                            $sql2 = "INSERT IGNORE INTO event_user(id_user, id_event, date_added, priorityy) VALUES ('$idUser', '$idEvent', CURRENT_TIMESTAMP, 2);";
                            $result2 = mysqli_query($conn, $sql2);

                            $contents = "You have been invited to the event ".$idEvent."<br>by ".$_SESSION['login'];
                            $contents.="<br>Date and time: ".$eventDate."  ".$eventTime;
                            $contents.="<br>Place: ".$eventPlace;
                            $contents.="<br>Game: ".$eventGame;

                            $notification = "INSERT INTO notificationn (id_user, id_event, notif_read, notif_contents) VALUES ('$idUser', '$idEvent', 0, '$contents');";
                            $resultnotif = mysqli_query($conn, $notification);
           
                        }
                    }
                    $sql2 = "INSERT IGNORE INTO event_user(id_user, id_event, date_added, priorityy, date_accept) VALUES ('$idInitiator', '$idEvent',CURRENT_TIMESTAMP, 1,CURRENT_TIMESTAMP);";
                    $result2 = mysqli_query($conn, $sql2);
                    if($result2){
                        header("Location: viewEventList.php?createEvent=success");
                    }else {
                        header("Location: viewEventList.php?error=addUsersFailed");
                    }
                }else{
                    header("Location: viewEventList.php?error=createEventFailed");
                }
                
            }else{
                header("Location: viewEventList.php?error=gameIsNotAccepted");
            }

        }
    }
?>