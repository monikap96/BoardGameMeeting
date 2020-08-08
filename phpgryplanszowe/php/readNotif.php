<?php
    session_start();
    include_once 'dbConnection.php';
    $actualUserId = $_SESSION['id'];

    $notifId = $_POST["notifId"];
    if($_SESSION['id']){
        if($notifId){
            $sqlFindNotif = "SELECT * FROM notificationn WHERE id_notif=".$notifId." AND id_user=".$_SESSION['id'].";";
            $resultFindNotif = mysqli_query($conn, $sqlFindNotif);
            if(mysqli_num_rows($resultFindNotif)==1){
                $rowFindNotif = mysqli_fetch_assoc($resultFindNotif);
                if($rowFindNotif['notif_read']==0){
                $sqlUpdate = "UPDATE notificationn SET notif_read=1 WHERE id_notif=".$notifId.";";
                $resultSqlUpdate = mysqli_query($conn, $sqlUpdate);
            
                }else{
                    header("Location: homePage.php");
                }
            }
        }else{
            header("Location: homePage.php");
        }
    }
?>