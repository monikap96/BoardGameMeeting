<?php 
    session_start();
    include_once 'dbConnection.php'; 
    $userId = $_GET["uid"];
    
    $sqlActualUser = "SELECT * FROM user WHERE id_user=".$_SESSION["id"].";";
    $resultActualUser = mysqli_query($conn, $sqlActualUser);
    while($rowActualUser = mysqli_fetch_assoc($resultActualUser)){
        if($rowActualUser['user_role']=="administrator"){
            $sql = "SELECT user_activated FROM user WHERE id_user='$userId';";
            $result = mysqli_query($conn, $sql);
            if($result){
                $row = mysqli_fetch_assoc($result);
                if($row['user_activated']=='0'){
                    $isActiv = '1';
                }else{
                    $isActiv = '0';
                }
                $isActiv = !$row['user_activated'];
                $upt = "UPDATE user SET user_activated='$isActiv' WHERE id_user='$userId';";
                $result2 = mysqli_query($conn, $upt);
                if($result2){
                    header("Location: viewAdminPanelUsers.php?activate=success");
                }else{
                    header("Location: viewAdminPanelUsers.php?activate=error");
                }
            }
        }else{
            header("Location: homePage.php");
        }
    }

?>