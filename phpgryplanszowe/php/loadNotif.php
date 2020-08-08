<?php
    session_start();
    include_once 'dbConnection.php';
    $actualUserId = $_SESSION['id'];
    if($actualUserId){
        $sqlNotif = "SELECT * FROM notificationn WHERE id_user=".$actualUserId." ORDER BY id_notif DESC;";
        $resultNotif = mysqli_query($conn, $sqlNotif);

        while($rowNotif= mysqli_fetch_assoc($resultNotif)){
            $idNotif = $rowNotif['id_notif'];
            $idEvent = $rowNotif['id_event'];
            if(strpos($rowNotif['notif_contents'], "changed")){
                if($rowNotif['notif_read']==0){
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'><b>Event ".$idEvent." has been changed</b><br>";
                }else{
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'>Event ".$idEvent." has been changed<br>";
                }
            }else if(strpos($rowNotif['notif_contents'], "deleted")){
                if($rowNotif['notif_read']==0){
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'><b>Event ".$idEvent." has been deleted</b><br>";
                }else{
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'>Event ".$idEvent." has been deleted<br>";
                }
            }else if(strpos($rowNotif['notif_contents'], "invited")){
                if($rowNotif['notif_read']==0){
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'><b>You have been invited to the event ".$idEvent."</b><br>";
                }else{
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'>You have been invited to the event ".$idEvent."<br>";
                }
            }else if(strpos($rowNotif['notif_contents'], "left event")){
                if($rowNotif['notif_read']==0){
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'><b>Someone has just left event ".$idEvent."</b><br>";
                }else{
                    echo "<a class='anavbar' id='notification' onclick='showNotifId(\"".$rowNotif['id_notif']."\",\"".$rowNotif['notif_contents']."\",\"".$idEvent."\")'>Someone has just left event ".$idEvent."<br>";
                }
            }
            if($rowNotif['notif_read']==0){
                echo "<b>".$rowNotif['notif_date']."</b></a>";
            }else{
                echo $rowNotif['notif_date']."</a>";
            }
        }
    }
    
?>