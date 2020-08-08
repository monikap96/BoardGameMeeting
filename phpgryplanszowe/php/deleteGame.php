<?php 
    session_start();
    include_once 'dbConnection.php';
    $gameId = $_GET["gid"];
    $actualUserId = $_SESSION['id'];
    $sqlActualUserId = "SELECT * FROM user WHERE id_user=".$actualUserId.";";
    $resultActualUserId = mysqli_query($conn, $sqlActualUserId);
    $rowActualUserId = mysqli_fetch_assoc($resultActualUserId);
    $roleActualUser = $rowActualUserId['user_role'];
    if($roleActualUser == 'administrator' || $roleActualUser == 'admin'){
        $sqlDeleteEventUsers = "DELETE FROM game WHERE id_game='".$gameId."';";
        $resultDeleteEventUsers = mysqli_query($conn, $sqlDeleteEventUsers);
        if($resultDeleteEventUsers){
            header("Location: viewAdminPanelGames.php?deleteGame=success");
        }else{
            header("Location: viewAdminPanelGames.php?deleteGame=error");
        }
    }else{
        header("Location: homePage.php?deleteGame=noPermission");
    }
?>