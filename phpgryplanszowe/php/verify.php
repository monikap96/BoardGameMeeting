<?php
    session_start();
    include_once 'dbConnection.php';
    if(isset($_GET['vkey'])){
        $vkey = $_GET['vkey'];
        $sql = "SELECT * FROM user WHERE user_activated=0 AND verif_key LIKE '".$vkey."';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)==1){
            echo $row['user_login'];
            $sqlUpdate = "UPDATE user SET user_activated=1 WHERE verif_key LIKE '".$vkey."';";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            if($resultUpdate){
                header("Location: homePage.php?verification=success"); 
            }else{
                header("Location: homePage.php?verification=error"); 
            }
        }else{
            header("Location: homePage.php?verification=alreadyConfirmed"); 
        }
    }else{
        header("Location: homePage.php?verification=noKey"); 
    }
?>