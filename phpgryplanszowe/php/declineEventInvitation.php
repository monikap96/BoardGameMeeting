<?php
    session_start();
    include_once 'dbConnection.php';
    $eventId = $_GET["evid"];
    $actualUserId = $_SESSION['id'];

    $sql = "SELECT * FROM eventt WHERE id_event='".$eventId."';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)==0){
        header("Location: viewEventList.php?event=notFound");
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $date = date("Y-m-d");
            $time =  date("H:i:s");
            $eventDate = $row['event_date'];
            $eventTime = $row['event_time'];
        }

        if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
            $sqlEventUsers = "SELECT * FROM event_user WHERE id_event=".$eventId." AND id_user=".$actualUserId.";";
            $resultEventUsers = mysqli_query($conn, $sqlEventUsers);
            if(mysqli_num_rows($resultEventUsers)==1){
                $deleteEventUser = "DELETE FROM event_user WHERE id_event=".$eventId." AND id_user=".$actualUserId.";";
                $resultDeleteEventUser = mysqli_query($conn, $deleteEventUser);
                if($resultDeleteEventUser){
                    $contents = "Someone has just left event ".$eventId.".";

                    $sglAllUsers = "SELECT * FROM event_user WHERE id_event=".$eventId." AND priorityy=3;";
                    $resultAllUsers = mysqli_query($conn, $sglAllUsers);
                    while($rowUsers = mysqli_fetch_assoc($resultAllUsers)){
                        $idUser = $rowUsers['id_user'];

                        $notification = "INSERT INTO notificationn (id_user, id_event, notif_read, notif_contents) VALUES ('$idUser', '$eventId', 0, '$contents');";
                        $resultnotif = mysqli_query($conn, $notification);
                    }
                    header("Location: viewEventList.php?declineEventInvitation=success");
                }else{
                    header("Location: viewEventList.php?declineEventInvitation=error");
                }
            
            }else{
                header("Location: viewEventList.php?error=alreadyNotExistInEvent");
            }
        }else{
            header("Location: viewEventList.php?declineEventInvitation=outOfTime");
        }
    }
   
?>