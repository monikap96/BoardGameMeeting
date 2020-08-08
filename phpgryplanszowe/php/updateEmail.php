<?php
    session_start();
    include_once 'dbConnection.php';
    $idUser = $_SESSION['id'];
  
    if(isset($_POST['submit'])){
        $newEmail = $_POST["thisIsMyNewMail"];

        $sqlUpdate = "UPDATE user SET user_email='$newEmail' WHERE id_user='$idUser';";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);
        if($resultUpdate){
            header("Location: editAccountSettings.php?changeEmail=success");
        }else{
            header("Location: editAccountSettings.php?changeEmail=error");
        }
    }
?>