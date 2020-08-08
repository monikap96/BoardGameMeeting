<?php 
    session_start();
    include_once 'dbConnection.php'; 
    $actualUserId = $_SESSION['id'];
    $sqlActualUser = "SELECT * FROM user WHERE id_user=".$actualUserId.";";
    $resultActualUser = mysqli_query($conn, $sqlActualUser);
    $row4 = mysqli_fetch_assoc($resultActualUser);
    $actualUserRole = $row4['user_role'];
    if(isset($_POST['submit'])){
        $chosenRole = $_POST['roles'];
        $chosenUser = $_POST['chosenUser'];
        if($actualUserRole=="administrator"){
            $sqlUpdate="UPDATE user SET user_role='".$chosenRole."' WHERE id_user=".$chosenUser.";";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            if($resultUpdate){
                header("Location: viewAdminPanelUsers.php?changeRole=success");
            }else{
                header("Location: viewAdminPanelUsers.php?changeRole=error");
            }
        }else if($actualUserRole=="admin"){
            $sqlChosenUser = "SELECT * FROM user WHERE id_user=".$chosenUser.";";
            $resultChosenUser = mysqli_query($conn, $sqlChosenUser);
            $rowChosenUser = mysqli_fetch_assoc($resultChosenUser);
            $chosenUserRole = $rowChosenUser['user_role'];
            if($chosenUserRole == "administrator"){
                header("Location: viewAdminPanelUsers.php?changeRole=noPermission");
            }else{
                if($chosenRole == "admin" || $chosenRole == "user"){
                    $sqlUpdate="UPDATE user SET user_role='".$chosenRole."' WHERE id_user=".$chosenUser.";";
                    $resultUpdate = mysqli_query($conn, $sqlUpdate);
                    if($resultUpdate){
                        header("Location: viewAdminPanelUsers.php?changeRole=success");
                    }else{
                        header("Location: viewAdminPanelUsers.php?changeRole=error");
                    }
                }else{
                    header("Location: viewAdminPanelUsers.php?changeRole=noPermission");
                }
            }
        }else{
            header("Location: viewAdminPanelUsers.php?changeRole=noPermission");
        } 
    }
?>