<?php
    session_start();
    include_once 'dbConnection.php';
    $loginValue = $_SESSION['login'];

    $sql = "SELECT * FROM user WHERE user_login LIKE '".$loginValue."';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $idUser = $row['id_user'];

    if(isset($_POST['submit'])){
        $old = $_POST['oldPassword'];
        $old = md5($old);
        if($old == $row['user_password']){
            $newPass = $_POST["thisIsMyNewPasscode"];
            $newPass = md5($newPass);    
            $sqlUpdate = "UPDATE user SET user_password='$newPass' WHERE id_user='$idUser';";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            if($resultUpdate){
                header("Location: editAccountSettings.php?changePass=success");
            }else{
                header("Location: editAccountSettings.php?changePass=error");
            }
        }else{
            header("Location: editAccountSettings.php?changePass=incorrectPass");
        }
    }
?>