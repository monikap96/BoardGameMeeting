<?php
    session_start();
    include_once 'dbConnection.php';
    $actualUserId = $_SESSION['id'];
    if(isset($_POST['submit'])){
        $gameName = $_POST['gameName'];
        $gameMinPlayers =$_POST['gameMinPlayers'];
        $gameMaxPlayers = $_POST['gameMaxPlayers'];
        $gameMinAge = $_POST['gameMinAge'];
        $gameMaxAge = $_POST['gameMaxAge'];
        $gameImage = $_POST['gameImage'];
        $gameDescriptionText = $_POST['gameDescriptionText'];
        $gameAccepted = $_POST['gameAccepted'];

        $gameDescriptionText = str_replace("'", "''", $gameDescriptionText);
        $gameDescriptionText = nl2br($gameDescriptionText);
        
        $file = $_FILES['file'];

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
                    $sql = "INSERT INTO game (game_name, game_min_players, game_max_players, game_min_age, game_max_age, game_description, game_image, game_created_by, game_accepted)
                    VALUES ('$gameName', '$gameMinPlayers','$gameMaxPlayers', '$gameMinAge', '$gameMaxAge', '$gameDescriptionText','0', '$actualUserId', '2');";
                    $result=mysqli_query($conn, $sql);
                    if($result){
                        $lastid=mysqli_insert_id($conn);
                        $idGame = $lastid;

                        $fileNameNew = "gameimg".$idGame.".".$fileActualExt;
                        $fileDestination =  '../games/'.$fileNameNew;
                        if(move_uploaded_file($fileTmpName, $fileDestination)){
                            $img = "UPDATE game SET game_image=1 WHERE id_game=".$idGame.";";
                            $resultImg =  mysqli_query($conn, $img);
                            if($resultImg){
                                header("Location: viewGameList.php?createGame=success");
                            }else{
                                header("Location: viewGameList.php?createGame=imgfailed");
                            }
                            
                        }else{
                            header("Location: viewGameList.php?createGame=imgmovedfailed");

                        }

                    }else{
                        header("Location: viewGameList.php?createGame=failed");
                    }
                }else{
                    header("Location: viewGameList.php?gameimage=fileTooBig");
                }
            }else{
                header("Location: viewGameList.php?gameimage=error");
            }
        }else{
        header("Location: viewGameList.php?gameimage=wrongType");
        }
    }

?>