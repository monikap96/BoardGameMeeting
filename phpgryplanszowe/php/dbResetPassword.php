<?php
    session_start();
    include_once 'dbConnection.php';
    if(isset($_POST['submit'])){
        $vkey =$_GET['vkey'];
        $passprivate = $_POST['itisyourpriviet'];
        $passprivate=md5($passprivate);
        $sql = "SELECT * FROM user WHERE verif_key LIKE '".$vkey."';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)==1){
            $sqlUpdate = "UPDATE user SET user_password='".$passprivate."' WHERE verif_key='".$vkey."';";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            if($resultUpdate){
                header("Location: homePage.php?changePassword=success"); 
            }else{
                header("Location: homePage.php?changePassword=error"); 
            }
        }else{
            header("Location: homePage.php?error=userkeyNotFound"); 
        }
    }
?>