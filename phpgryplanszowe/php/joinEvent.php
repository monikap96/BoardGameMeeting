<?php
    session_start();
    include_once 'dbConnection.php';
    $loginValue = $_SESSION['login'];
    $eventId = $_GET["evid"];
    $actualUserId = $_SESSION['id'];
    
    $sqlFindEvent = "SELECT * FROM eventt WHERE id_event='".$eventId."';";
    $resultFindEvent = mysqli_query($conn, $sqlFindEvent);
    if (mysqli_num_rows($resultFindEvent)==0){
        header("Location: viewEventList.php?event=notFound");
    }else{      
        while($rowFindEvent = mysqli_fetch_assoc($resultFindEvent)){
            $eventInitiator = $rowFindEvent['event_initiator'];
            $date = date("Y-m-d");
            $time =  date("H:i:s");
            $eventDate = $rowFindEvent['event_date'];
            $eventTime = $rowFindEvent['event_time'];
            $maxPlayers = $rowFindEvent['event_max_players'];
            if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
                
                $sqlEventUsers = "SELECT * FROM event_user WHERE id_event=".$eventId." AND id_user=".$actualUserId.";";
                $resultEventUsers = mysqli_query($conn, $sqlEventUsers);
                if(mysqli_num_rows($resultEventUsers)==0){
                    $sqlCountAccepted = "SELECT COUNT(id_user) as countt FROM event_user WHERE id_event=".$eventId." AND (priorityy=1 OR priorityy=2);";
                    $resultCountAccepted = mysqli_query($conn, $sqlCountAccepted);
                    $rowCountAccepted= mysqli_fetch_assoc($resultCountAccepted);

                    if($rowCountAccepted['countt']<$maxPlayers){
                        $sqlJoinUser = "INSERT INTO event_user (id_user, id_event, priorityy, date_added, date_accept)
                        VALUES ('$actualUserId', '$eventId', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
                        $resultJoinUser = mysqli_query($conn, $sqlJoinUser);
                        if($resultJoinUser){
                            header("Location: viewEventList.php?joinEvent=success");
                        }else{
                            header("Location: viewEventList.php?joinEvent=error");
                        }
                    }else{
                        $sqlJoinUser = "INSERT INTO event_user (id_user, id_event, priorityy, date_added)
                        VALUES ('$actualUserId', '$eventId', 3, CURRENT_TIMESTAMP);";
                        $resultJoinUser = mysqli_query($conn, $sqlJoinUser);
                        if($resultJoinUser){
                            header("Location: viewEventList.php?interested=success");
                        }else{
                            header("Location: viewEventList.php?interested=error");
                        }
                    }
                    
                }else{
                    $rowEventUser = mysqli_fetch_assoc($resultEventUsers);
                    $priorityy = $rowEventUser['priorityy'];
                    if($priorityy==3 || $priorityy==2){
                        $sqlCountAccepted = "SELECT COUNT(id_user) as countt FROM event_user WHERE id_event=".$eventId." AND (priorityy=1 OR priorityy=2);";
                        $resultCountAccepted = mysqli_query($conn, $sqlCountAccepted);
                        $rowCountAccepted= mysqli_fetch_assoc($resultCountAccepted);

                        if($rowCountAccepted['countt']<$maxPlayers){
                            $updateEventUser = "UPDATE event_user SET priorityy=1, date_accept=CURRENT_TIMESTAMP WHERE id_event=".$eventId." AND id_user=".$actualUserId.";";
                            $resultUpdateEventUser = mysqli_query($conn, $updateEventUser);
                            if($resultJoinUser && $priorityy==2){
                                header("Location: viewEventList.php?acceptEventInvitation=success");
                            }else{
                                header("Location: viewEventList.php?acceptEventInvitation=error");
                            }
                        }else{
                            header("Location: viewEventList.php?error=stillInInterested");
                        }
                    }else{
                        header("Location: viewEventList.php?joinEvent=alreadyJoined");
                    }
                }
            }else{
                header("Location: viewEventList.php?joinEvent=outOfTime");
            }
        }
    }
    
?>