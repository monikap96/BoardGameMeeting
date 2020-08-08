<?php
    session_start();
    include_once 'dbConnection.php';

    $eventId = $_GET["evid"];
    $userId = $_GET["uid"];

    $sql = "SELECT * FROM eventt WHERE id_event=".$eventId.";";
    $result = mysqli_query($conn, $sql);
    if(mysqli_fetch_assoc($result)){
        $sql2 = "INSERT IGNORE INTO event_user(id_user, id_event, date_added, priorityy) VALUES ('$userId', '$eventId', CURRENT_TIMESTAMP, 2);";
        $result2 = mysqli_query($conn, $sql2);
            
        if($result2){
            header("Location: viewEvent.php?evid=".$eventId."");
        }else {
            header("Location: viewEventList.php?error=joinFailed");
        }
    }else{
        header("Location: viewEventList.php?error=eventNotFound");
    }
?>