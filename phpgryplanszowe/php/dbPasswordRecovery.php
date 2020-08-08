<?php
    session_start();
    include_once 'dbConnection.php';
    if(isset($_POST['submit'])){
        $mailaddress = $_POST["emailaddress"];
        $sql = "SELECT * FROM user WHERE user_email LIKE '".$mailaddress."';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_assoc($result);
            $itisyouruniqname =$row['user_login'];
            $vkey = md5(time().$itisyouruniqname);
            $sqlUpdate = "UPDATE user SET verif_key='".$vkey."' WHERE user_email LIKE '".$mailaddress."';";
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            if($resultUpdate){
                $from = 'boardgamemeeting@yellowparrot.pl';
                $to = $mailaddress;
                $subject = "BoardGameMeeting - Password reset";
                
                $message = '<h2>Hello '.$itisyouruniqname.'</h2>';
                $message .= '<h2>Have you forgotten your password?</h2><h3><Click the link below and enter a new password</h3><a href="http://yellowparrot.pl/phpgryplanszowe/php/formResetPassword.php?vkey='.$vkey.'">Reset youer password here</a><h4>If you have not reset your password, just delete this email and everything will be ok</h4>';
        
                $headers  = "From: Email ze strony < boardgamemeeting@yellowparrot.pl >\n";
                $headers .= "X-Sender: Email ze strony < boardgamemeeting@yellowparrot.pl >\n";
                $headers .= 'X-Mailer: PHP/' . phpversion();
                $headers .= "X-Priority: 1\n"; 
                $headers .= "Return-Path: boardgamemeeting@yellowparrot.pl\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\n";
                $headers .= "Reply-to: ".$to."\r\n";
                
                if( mail($to, $subject, $message, $headers)){
                    header("Location: homePage.php?resetPassword=success"); 
                }else{
                    header("Location: homePage.php?error=mail"); 
                }
            }else{
                header("Location: homePage.php?resetPassword=error"); 
            }
        }else{
            header("Location: homePage.php?error=usernameNotFound"); 
        }
    }
?>