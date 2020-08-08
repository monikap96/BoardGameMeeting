<?php
    session_start();
    include_once 'dbConnection.php';
    $loginValue = $_SESSION['login'];
    $eventId = $_GET["evid"];

    
    $sqlActualUserId = "SELECT id_user, user_login, user_role FROM user WHERE id_user= '".$_SESSION['id']."';";
    $resultActualUserId = mysqli_query($conn, $sqlActualUserId);
    $rowActualUserId = mysqli_fetch_assoc($resultActualUserId);

 
    $sqlFindEvent = "SELECT * FROM eventt WHERE id_event='".$eventId."';";
    $resultFindEvent = mysqli_query($conn, $sqlFindEvent);
    while($rowFindEvent = mysqli_fetch_assoc($resultFindEvent)){
        $eventInitiator = $rowFindEvent['event_initiator'];
        $date = date("Y-m-d");
        $time =  date("H:i:s");
        $eventDate = $rowFindEvent['event_date'];
        $eventTime = $rowFindEvent['event_time'];
        if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time) || ($rowActualUserId['user_role']=="administrator") || ($rowActualUserId['user_role']=="admin")){
            if($eventInitiator == $rowActualUserId['id_user']){
                $sqlDeleteRatesUsers = "DELETE FROM user_score WHERE id_event='".$eventId."';";
                $resultDeleteRatesUsers = mysqli_query($conn, $sqlDeleteRatesUsers);
                if($resultDeleteRatesUsers){
                    $sqlInitiator = "SELECT id_user, user_login FROM user WHERE id_user= '".$_SESSION['id']."';";
                    $resultInitiator = mysqli_query($conn, $sqlInitiator);
                    $rowInitiator = mysqli_fetch_assoc($resultInitiator);
                    $contents = "Event number ". $eventId." has been deleted by the initiator.<br>Initiator: ".$rowInitiator['user_login'];
                    $contents.="<br>Date: ".$rowFindEvent['event_date']."  ".$rowFindEvent['event_time'];
                    $contents.="<br>Place: ".$rowFindEvent['event_place'];
                    
                    $sqlIdUsers = "SELECT * FROM event_user WHERE id_event='".$idEvent."';";
                    $resultIdUsers = mysqli_query($conn, $sqlIdUsers);
                    while($rowIdUsers = mysqli_fetch_assoc($resultIdUsers)){
                        foreach($rowIdUsers['id_user'] as $users) {
                        $notification = "INSERT INTO notificationn (id_user, id_event, notif_read, notif_contents) VALUES ('$users', '$idEvent', 0, '$contents');";
                        $resultnotif = mysqli_query($conn, $notification);
                        }
                    }
                    $sqlDeleteEventUsers = "DELETE FROM event_user WHERE id_event='".$eventId."';";
                    $resultDeleteEventUsers = mysqli_query($conn, $sqlDeleteEventUsers);
                    if($resultDeleteEventUsers){
                        $sqlDeleteEvent = "DELETE FROM eventt WHERE id_event='".$eventId."';";
                        $resultDeleteEvent = mysqli_query($conn, $sqlDeleteEvent);
                        if($resultDeleteEvent){
                            header("Location: viewEventList.php?deleteEvent=success");
                        }else{
                            header("Location: viewEventList.php?deleteEvent=deleteEventFailed");
                        }
                    }else{
                        header("Location: viewEventList.php?deleteEvent=deleteEventUsersFailed");
                    }
                }else{
                    header("Location: viewEventList.php?deleteEvent=deleteRatesUsersFailed");
                }
            }else{
                header("Location: viewEventList.php?error=noPermission");
            }
        }else{
            header("Location: viewEventList.php?error=tooLate");
        }
    }


?>