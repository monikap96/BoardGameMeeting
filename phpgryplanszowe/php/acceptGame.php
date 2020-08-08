<?php
    session_start();
    include_once 'dbConnection.php';
    $gameId = $_GET['gid'];

    $user = "SELECT * FROM user WHERE id_user=".$_SESSION['id'].";";
    $resultUser = mysqli_query($conn, $user);
    while($rowUser = mysqli_fetch_assoc($resultUser)){
        $role = $rowUser['user_role'];
        if($role=="administrator" || $role=="admin"){
            $sql = "UPDATE game SET game_accepted='1' WHERE id_game='$gameId';";
            $result = mysqli_query($conn, $sql);
            if($result){
                header("Location: viewAdminPanelGames.php?acceptgame=success");
            }else{
                header("Location: viewAdminPanelGames.php?acceptgame=error");
            }
        }else{
            header("Location: homePage.php");
        }
    }
?>