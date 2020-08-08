<?php
    session_start();
    include_once 'dbConnection.php';
    $eventId = $_GET["evid"];
    
    $actualUserId = $_SESSION['id'];
    
    $sqlFindEvent = "SELECT * FROM eventt WHERE id_event='".$eventId."';";
    $resultFindEvent = mysqli_query($conn, $sqlFindEvent);
    while($rowFindEvent = mysqli_fetch_assoc($resultFindEvent)){
        $eventInitiator = $rowFindEvent['event_initiator'];
        $date = date("Y-m-d");
        $time =  date("H:i:s");
        $eventDate = $rowFindEvent['event_date'];
        $eventTime = $rowFindEvent['event_time'];
        if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time) || ($rowActualUserId['user_role']=="administrator") || ($rowActualUserId['user_role']=="admin")){
            $sqlEventUsers = "SELECT * FROM event_user WHERE id_event=".$eventId." AND id_user=".$actualUserId.";";
            $resultEventUsers = mysqli_query($conn, $sqlEventUsers);
            if(mysqli_num_rows($resultEventUsers)>0){
                $rowEventUsers = mysqli_fetch_assoc($resultEventUsers);
                $priorityy = $rowEventUsers['priorityy'];
                $sqlLeaveUser = "DELETE FROM event_user WHERE id_user=".$actualUserId." AND id_event=".$eventId.";";
                $resultLeaveUser = mysqli_query($conn, $sqlLeaveUser);
                if($resultLeaveUser){
                    if($priorityy==2 || $priorityy==1){
                        $contents = "Someone has just left event ".$eventId.".";

                        $sglAllUsers = "SELECT * FROM event_user WHERE id_event=".$eventId." AND priorityy=3;";
                        $resultAllUsers = mysqli_query($conn, $sglAllUsers);
                        while($rowUsers = mysqli_fetch_assoc($resultAllUsers)){
                            $idUser = $rowUsers['id_user'];
    
                            $notification = "INSERT INTO notificationn (id_user, id_event, notif_read, notif_contents) VALUES ('$idUser', '$eventId', 0, '$contents');";
                            $resultnotif = mysqli_query($conn, $notification);
                        }
                    }
                    header("Location: viewEventList.php?leaveEvent=success");
                }else{
                    header("Location: viewEventList.php?leaveEvent=error");
                }
            }else{
                header("Location: viewEventList.php?leaveEvent=alreadyLeaved");
            }
        }else{
            header("Location: viewEventList.php?leaveEvent=outOfTime");
        }
    }

?>