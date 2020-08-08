<?php
    session_start();
    include_once 'dbConnection.php';
    if(isset($_POST['submitR'])){
        $actualUserId = $_SESSION['id'];
        $chosenUser = $_POST['chosenUser'];
        $actualEventId = $_POST['actualEvent'];
        $rate = $_POST['rates'];
        
        $sqlFindEvent = "SELECT * FROM eventt WHERE id_event=".$actualEventId.";";
        $resultFindEvent = mysqli_query($conn, $sqlFindEvent);
        while($rowFindEvent = mysqli_fetch_assoc($resultFindEvent)){
            $date = date("Y-m-d");
            $time =  date("H:i:s");
            $eventDate = $rowFindEvent['event_date'];
            $eventTime = $rowFindEvent['event_time'];
            $startTime = date('H:i:s', strtotime($eventTime.'+2 hours'));
            $endDate = date('Y-m-d', strtotime("+7 days", strtotime($eventDate)));
            if((($eventDate<$date) || ($eventDate==$date && $startTime<$time)) && ($endDate>$date)){
                $sqlFindEventUser = "SELECT * FROM event_user WHERE id_event=".$actualEventId." AND priorityy=1 AND (id_user=".$actualUserId." OR id_user=".$chosenUser.") ;";
                $resultFindEventUser = mysqli_query($conn, $sqlFindEventUser);
                if(mysqli_num_rows($resultFindEventUser)==2){
                    $sqlFindIfExist = "SELECT * FROM user_score WHERE id_event=".$actualEventId." AND id_rated_by_user=".$actualUserId." AND id_rated_user=".$chosenUser.";";
                    $resultFindIfExist = mysqli_query($conn, $sqlFindIfExist);
                    if($rate!=0){
                        if(mysqli_num_rows($resultFindIfExist)==0){
                            $sqlAddRate = "INSERT INTO user_score (id_event, id_rated_by_user, id_rated_user, score)
                            VALUES ('$actualEventId', '$actualUserId', '$chosenUser', '$rate');";
                            $resultAddRate = mysqli_query($conn, $sqlAddRate);
                            if($resultAddRate){
                                header("Location: viewEvent.php?evid=".$actualEventId."&rateUser=success");
                            }else{
                                header("Location: viewEventList.php?evid=".$actualEventId."&rateUser=error");
                            }
                        }else if(mysqli_num_rows($resultFindIfExist)==1){
                            $sqlUpdateRate = "UPDATE user_score SET score=".$rate." WHERE id_event=".$actualEventId." AND id_rated_by_user=".$actualUserId." AND id_rated_user=".$chosenUser.";";
                            $resultUpdateRate = mysqli_query($conn, $sqlUpdateRate);
                            if($resultUpdateRate){
                                header("Location: viewEvent.php?evid=".$actualEventId."&rateUser=success");
                            }else{
                                header("Location: viewEventList.php?evid=".$actualEventId."&rateUser=error");
                            }
                        }
                    }else{
                        $sqlDeleteRate = "DELETE FROM user_score WHERE id_event=".$actualEventId." AND id_rated_by_user=".$actualUserId." AND id_rated_user=".$chosenUser.";";
                        $resultDeleteRate = mysqli_query($conn, $sqlDeleteRate);
                        if($resultDeleteRate){
                            header("Location: viewEvent.php?evid=".$actualEventId."&rateUser=success");
                        }else{
                            header("Location: viewEventList.php?evid=".$actualEventId."&rateUser=error");
                        }
                    }
                }else{
                    header("Location: homePage.php");
                }
            }else{
                header("Location: homePage.php");
            }
        }
    }else{
        header("Location: homePage.php");
    }
?>