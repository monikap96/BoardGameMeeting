<?php
    session_start();
    include_once 'dbConnection.php';
    if(isset($_POST['update'])){
        $gameId = $_POST['gameId'];
        $gameName = $_POST['gameName'];
        $gameMinPlayers =$_POST['gameMinPlayers'];
        $gameMaxPlayers = $_POST['gameMaxPlayers'];
        $gameMinAge = $_POST['gameMinAge'];
        $gameMaxAge = $_POST['gameMaxAge'];
        $gameDescriptionText = $_POST['gameDescriptionText'];
        $gameAccepted = $_POST['gameAccepted'];
        $gameDescriptionText = nl2br($gameDescriptionText);
        $gameDescriptionText = str_replace("'", "''", $gameDescriptionText);

        $file = $_FILES['file'];
        
        if($fileName){

            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
    
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg','jpeg','png');

            if(in_array($fileActualExt,$allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $fileNameNew = "gameimg".$gameId.".".$fileActualExt;
                        $fileDestination =  '../games/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $sql = "UPDATE game SET game_name='$gameName', game_min_players='$gameMinPlayers', game_max_players='$gameMaxPlayers', game_min_age='$gameMinAge', game_max_age='$gameMaxAge', game_description='$gameDescriptionText', game_image='1', game_accepted='$gameAccepted', game_image='1' WHERE id_game='$gameId';";
                        $result = mysqli_query($conn, $sql);
                         if($result){
                            header("Location: viewAdminPanelGames.php?editgame=success");
                        }else{
                            header("Location: viewAdminPanelGames.php?editgame=error");
                        }
                    }else{
                        header("Location: viewAdminPanelGames.php?gameimgchanged=fileTooBig");
                    }
                }else{
                    header("Location: viewAdminPanelGames.php?gameimgchanged=error");
                }
            }else{
                header("Location: viewAdminPanelGames.php?gameimgchanged=wrongType");
            }
        }else{
            $sql = "UPDATE game SET game_name='$gameName', game_min_players='$gameMinPlayers', game_max_players='$gameMaxPlayers', game_min_age='$gameMinAge', game_max_age='$gameMaxAge', game_description='$gameDescriptionText', game_accepted='$gameAccepted' WHERE id_game='$gameId';";
            $result = mysqli_query($conn, $sql);
             if($result){
                header("Location: viewAdminPanelGames.php?editgame=success");
            }else{
                header("Location: viewAdminPanelGames.php?editgame=error");
            }
        }
    }
?>