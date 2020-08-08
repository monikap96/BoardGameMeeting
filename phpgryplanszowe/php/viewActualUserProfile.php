<?php
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>
    <body>

        <div id="nav-placeholder"></div>
         <script>
        $(function(){
            $("#nav-placeholder").load("navbar.php");
        });

        </script>
        <?php
            include_once 'dbConnection.php';
            $actualUserId = $_SESSION['id'];
            $actualUser = $_SESSION['login'];

            $sqlActualUser = "SELECT * FROM user WHERE user_login LIKE '".$actualUser."';";
            $resultActualUser = mysqli_query($conn, $sqlActualUser);
            $rowActualUser= mysqli_fetch_assoc($resultActualUser);
        ?>    
        
        <div class="divcenter">
            <h1 class="title">User profile</h1>
            <div class="profileUserImg inlineblock">
                <h2 id="userLogin"><?php echo $_SESSION['login']; ?></h2>
            <?php
                if($rowActualUser['user_avatar']==1){
                    echo "<img src='../avatars/profile".$actualUserId.".jpg?'".mt_rand().">";
                }else{
                    echo "<img src='../avatars/profiledefault.jpg'>";
                }

                $sqlRoundAvgRate = "SELECT ROUND(AVG(score),2) AS avg_rate FROM user_score WHERE id_rated_user=".$actualUserId.";";
                $resultRoundAvgRate = mysqli_query($conn, $sqlRoundAvgRate);
                $rowAvgRate= mysqli_fetch_assoc($resultRoundAvgRate);
                echo "<h3>Rate: ".$rowAvgRate['avg_rate'].'</h3>';
            ?>
            </div>
            <div id="aboutMeDiv" class="inlineblock">
            <h3>About me</h3>
            <textarea id="aboutMe" cols="50" rows="10" value=""  readonly></textarea>
            </div>
        </div>
    </body>
    <script>
        setValues();
        function setValues() {
            document.getElementById("aboutMe").value = `<?php echo $rowActualUser['user_description']; ?>`;
        }
    </script>
</html>