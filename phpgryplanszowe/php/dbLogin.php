<?php
    include_once 'dbConnection.php';
    if(isset($_POST['submit'])){
        $yourloginisinmyhands = $_POST['ivegotyourloginmydear'];
        $yourpasswordisinmymind = $_POST['andyourpasswordtoo'];
        $yourpasswordisinmymind = md5($yourpasswordisinmymind);
        $sql = "SELECT * FROM user WHERE user_login='$yourloginisinmyhands' AND user_password='$yourpasswordisinmymind' LIMIT 1";
        
        $resultSql = mysqli_query($conn, $sql);
        if(mysqli_num_rows($resultSql)){
            $row = mysqli_fetch_assoc($resultSql);
            if($row['user_activated']==1){
                $id = $row["id_user"];
                $login = $row["user_login"];
                if(session_status()!=PHP_SESSION_ACTIVE) {
                    session_start();
                    $_SESSION['id']= $id;
                    $_SESSION['login']= $login;
                }
                header("Location: homePage.php?login=success");
            }else{
                header("Location: homePage.php?login=accountIsNotConfirmed");
            }
        }else{
            header("Location: formLogin.php?error=invalidLoginOrPass");
        }
    }
?>