<?php
    session_start();
    include_once 'dbConnection.php';
    if(isset($_POST['submit'])){
        $itisyouruniqname = $_POST['thereisyournick'];
        $mailaddress = $_POST['mailaddress'];
        $yourpriviet = $_POST['itisyourpriviet'];
        $yourpriviet2 = $_POST['itisyourpriviet2'];
        $birthDate = $_POST['birthDate'];
        $vkey = md5(time().$itisyouruniqname);
        if(empty($itisyouruniqname) || empty($mailaddress) || empty($yourpriviet)){
            header("Location: formRegister.php?registration=errorempty"); 
            exit();
        }else{
            $sqlname = "SELECT * FROM user WHERE user_email LIKE '.$mailaddress.' OR user_login LIKE '.$itisyouruniqname.' ;";
            $resultName = mysqli_query($conn, $sqlname);
            if(mysqli_num_rows($resultName)>0){
                header("Location: formRegister.php?registration=errorUsernameOrEmailAlreadyExist"); 
                exit();
            }else{
                if($yourpriviet != $yourpriviet2){
                    header("Location: formRegister.php?registration=errorPasswordsAreDifferent"); 
                    exit();
                }else{
                    $yourpriviet = md5($yourpriviet);
                    $sql = "INSERT INTO user (user_login, user_email, user_role, user_password, verif_key, user_activated, user_avatar) 
                    VALUES ('$itisyouruniqname', '$mailaddress', 'user', '$yourpriviet', '$vkey', '0', '0');";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $sqlSelect = "SELECT * FROM user WHERE user_login LIKE '".$itisyouruniqname."' AND user_email LIKE '".$mailaddress."';";
                        $resultSelect = mysqli_query($conn, $sqlSelect);
                        
                        while($rowSelect = mysqli_fetch_assoc($resultSelect)){
                            $from = 'boardgamemeeting@yellowparrot.pl';
                            $to = $mailaddress;
                            $subject = "Confirmation of account creation";
                            $message = '<h2>We are glad that you joined us!</h2><br><a href="http://yellowparrot.pl/phpgryplanszowe/php/verify.php?vkey='.$vkey.'">Confirm e-mail address</a><h4>We just want to confirm your identity.<br>If you did not create an account with us, just delete this email and everything will return to normal.</h4>';

                            $headers  = "From: Email ze strony < boardgamemeeting@yellowparrot.pl >\n";
                            $headers .= "X-Sender: Email ze strony < boardgamemeeting@yellowparrot.pl >\n";
                            $headers .= 'X-Mailer: PHP/' . phpversion();
                            $headers .= "X-Priority: 1\n";
                            $headers .= "Return-Path: boardgamemeeting@yellowparrot.pl\n";
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: text/html; charset=utf-8\n";
                            $headers .= "Reply-to: ".$to."\r\n";
                            
                            if( mail($to, $subject, $message, $headers)){
                                header("Location: homePage.php?registration=success"); 
                            }else{
                                header("Location: homePage.php?error=mail"); 
                            }
                        }
                    }else{
                        header("Location: homePage.php?registration=errorr"); 
                    }
                }
            }
        }
    }
?>