<?php
    session_start();
    include_once 'dbConnection.php';

    $idUser = $_SESSION['id'];

    $aboutMe = $_POST["aboutMe"];

    $sqlUpdate = "UPDATE user SET user_description='$aboutMe' WHERE id_user='$idUser';";
    $resultUpdate = mysqli_query($conn, $sqlUpdate);
    if($resultUpdate){
        header("Location: editAccountSettings.php?changeDescr=success");
    }else{
        header("Location: editAccountSettings.php?changeDescr=error");
    }
?>