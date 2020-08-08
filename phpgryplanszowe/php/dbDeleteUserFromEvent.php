<?php
    session_start();
    include_once 'dbConnection.php';

    $eventId = $_GET["evid"];
    $userId = $_GET["uid"];

    $sql = "SELECT * FROM eventt WHERE id_event=".$eventId.";";
    $result = mysqli_query($conn, $sql);
    if(mysqli_fetch_assoc($result)){
        $sql2 = "DELETE FROM event_user WHERE id_event=".$eventId." AND id_user=".$userId.";";
        $result2 = mysqli_query($conn, $sql2);
            
        if($result2){
            $contents = "Someone has just left event ".$eventId.".";

            $sglAllUsers = "SELECT * FROM event_user WHERE id_event=".$eventId." AND priorityy=3;";
            $resultAllUsers = mysqli_query($conn, $sglAllUsers);
            while($rowUsers = mysqli_fetch_assoc($resultAllUsers)){
                $idUser = $rowUsers['id_user'];

                $notification = "INSERT INTO notificationn (id_user, id_event, notif_read, notif_contents) VALUES ('$idUser', '$eventId', 0, '$contents');";
                $resultnotif = mysqli_query($conn, $notification);
            }
            
            header("Location: viewEvent.php?evid=".$eventId."&deleteUserFromEvent=success");
            
        }else {
            header("Location: viewEvent.php?evid=".$eventId."&error=deleteUserFailed");
        }
    }
?>