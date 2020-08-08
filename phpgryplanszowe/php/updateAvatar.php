<?php
    session_start();
    include_once 'dbConnection.php';
    $actualUserId = $_SESSION['id'];
    if(isset($_POST['submit'])){
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
                    $fileNameNew = "profile".$actualUserId.".".$fileActualExt;
                    $fileDestination =  '../avatars/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $sql = "UPDATE user SET user_avatar=1 WHERE id_user=".$actualUserId.";";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        header("Location: editAccountSettings.php?avatarchanged=success");
                    }else{
                        header("Location: editAccountSettings.php?avatarchanged=failed");
                    }
                }else{
                    header("Location: editAccountSettings.php?avatarchanged=fileTooBig");
                }
            }else{
                header("Location: editAccountSettings.php?avatarchanged=error");
            }
        }else{
            header("Location: editAccountSettings.php?avatarchanged=wrongType");
        }
    }
?>