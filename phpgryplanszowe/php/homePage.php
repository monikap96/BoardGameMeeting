<?php 
  session_start();
  include_once 'dbConnection.php';

?>
<html>
  <head> 
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/homePage.js"></script>
  </head>

  <body id="homePageBody">
    <div>
    <div id="nav-placeholder"></div>

    <script>
    $(function(){
      $("#nav-placeholder").load("navbar.php");
    });
    </script>
    
    <?php
      if($_GET['login']=="accountIsNotConfirmed"){
        echo '<h4 class="error">Error: Account is not confirmed.</h4>';
      }else if($_GET['resetPassword']=="success"){
        echo '<h4 class="error">Password has been reset.</h4>';
      }else if($_GET['resetPassword']=="error"){
        echo '<h4 class="error">Error: Password has not been reset.</h4>';
      }else if($_GET['error']=="mail"){
        echo '<h4 class="error">Error: Email has not been sent.</h4>';
      }else if($_GET['error']=="usernameNotFound"){
        echo '<h4 class="error">Error: User not found.</h4>';
      }else if($_GET['changePassword']=="success"){
        echo '<h4 class="info">Password has been changed.</h4>';
      }else if($_GET['changePassword']=="error"){
        echo '<h4 class="error">Error: Password has not been changed.</h4>';
      }else if($_GET['error']=="userkeyNotFound"){
        echo '<h4 class="error">Error: Key not found.</h4>';
      }else if($_GET['registration']=="success"){
        echo '<h4 class="info">Registration success. Please check your registration email for email verification. Email may be in the spam folder, so please check its also.</h4>';
      }else if($_GET['registration']=="error"){
        echo '<h4 class="error">Error: Registration failed.</h4>';
      }else if($_GET['deleteGame']=="noPermission"){
        echo '<h4 class="error">Error: You have no permission.</h4>';
      }else if($_GET['verification']=="success"){
        echo '<h4 class="info">Verification success.</h4>';
      }else if($_GET['verification']=="error"){
        echo '<h4 class="error">Error: Verification failed.</h4>';
      }else if($_GET['verification']=="alreadyConfirmed"){
        echo '<h4 class="error">Error: Verification already confirmed.</h4>';
      }else if($_GET['verification']=="noKey"){
        echo '<h4 class="error">Error: Key not found.</h4>';
      }
    ?>

    
    <p id="welcometext"><b>
      Welcome in BoardGameMeeting!<br>
      If you like to play board games and meet new people,<br>
      then this website is for you!<br>
      You can join the event you are interested in <br>
      or create your own event <br>
      to which other users will be able to join
    </b></p>  

    <?php 
      if($_SESSION['id']){
        $actualUserId = $_SESSION['id'];
        $sqlEventsActualUser = "SELECT * FROM event_user WHERE id_user=".$actualUserId." AND priorityy=2 ORDER BY id_event ASC;";
			  $resultEventsActualUser = mysqli_query($conn, $sqlEventsActualUser);
        if(mysqli_num_rows($resultEventsActualUser)>0){
          
          echo"<h2 id='eventInvitationTitle'>Event Invitations:</h2><br><br>";
          echo "<div class='invitations'>";
          while($rowEvents = mysqli_fetch_assoc($resultEventsActualUser)){
            $idEv= $rowEvents['id_event'];
            $sqlEvents = "SELECT * FROM eventt WHERE id_event=".$idEv.";";
            $resultEvents = mysqli_query($conn, $sqlEvents);
            while($rowEvents = mysqli_fetch_assoc($resultEvents)){

              $date = date("Y-m-d");
              $time =  date("H:i");
              $eventDate = $rowEvents['event_date'];
              $eventTime = $rowEvents['event_time'];
              if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
                
                $sqlInitiator = "SELECT * FROM user WHERE id_user='".$rowEvents['event_initiator']."';";
                $resultInitiator = mysqli_query($conn, $sqlInitiator);
                while($rowInitiator = mysqli_fetch_assoc($resultInitiator)){
                  echo "<div class='invitation'>";
                  if($rowInitiator['user_avatar']==1){
                    echo "<div class='imgUsername' style='display: block; text-align: center;'><img class='smallAvatar' src='../avatars/profile".$rowInitiator['id_user'].".jpg?'".mt_rand().">";
                    echo "<label><b>".$rowInitiator["user_login"]."</label></div>";
                  }else{
                    echo "<div class='imgUsername' style='display: block; text-align: center;'><img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
                    echo "<label><b>".$rowInitiator["user_login"]."</label></div>";
                  }
                }
                echo "Date: ".$rowEvents['event_date'];
                $timeOfEvent = date('H:i', strtotime($rowEvents["event_time"]));
                echo "  ".$timeOfEvent."<br>";
                echo "Place: ".$rowEvents['event_place']."<br>";
                $sqlGame = "SELECT * FROM game WHERE id_game='".$rowEvents['event_game']."';";
                $resultGame = mysqli_query($conn, $sqlGame);
                while($rowGame = mysqli_fetch_assoc($resultGame)){
                  echo "Game: ".$rowGame['game_name']."</b><br>";
                  if($rowGame['game_image']==1){
                    echo "<img class='gameImage' src='../games/gameimg".$rowGame['id_game'].".jpg?'".mt_rand().">";
                  }else{
                    echo "<img class='gameImage' src='../games/boardgamedefault.png'>";
                  }
                }
                echo "<br>";
                echo '<button class="button join" type="button" id="joinE'.$rowEvents["id_event"].'" onclick="joinEvent('.$rowEvents["id_event"].')"><img src="../image/plus.svg" id="plus" class="icon under"/>Accept</button>';
                echo '<button class="button leave" type="button" id="declineE'.$rowEvents["id_event"].'" onclick="declineEvent('.$rowEvents["id_event"].')"><img src="../image/minus.svg" id="minus" class="icon under"/>Decline</button>';
                echo "</div>";

              }

            }
          }
          echo "</div>";
        }else{
          echo "<div><h3 id='eventNoInvitationTitle'>You do not have any invitations to events :c</h3></div><br><br>";
        }
      }
    ?>

    
    <table id="lastEvents" class="table">
    <tr>
      <th>Id</th>
      <th>Last added events</th>
      <th></th>
    <tr>
    <?php
      $sqlEvents = "SELECT * FROM eventt ORDER BY id_event DESC LIMIT 5;";
			$resultEvents = mysqli_query($conn, $sqlEvents);
			
      while($rowEvents = mysqli_fetch_assoc($resultEvents)){
        echo '<tr><td>'.$rowEvents["id_event"].'</td>';
        $sqlInitiator = "SELECT id_user, user_login, user_avatar FROM user WHERE id_user='".$rowEvents["event_initiator"]."';";
        $resultInitiator = mysqli_query($conn, $sqlInitiator);
        $rowInitiator = mysqli_fetch_assoc($resultInitiator);
        $initiator = $rowInitiator['user_login'];
        echo '<td class="breakWordHome"><b>Initiator:</b> '.$initiator.'<br>';
        $timeOfEvent = date('H:i', strtotime($rowEvents["event_time"]));
        echo '<b>'.$rowEvents["event_date"].'&nbsp&nbsp&nbsp'.$timeOfEvent.'</b><br>';
        echo '<b>Place:</b> '.$rowEvents["event_place"].'<br>';
        $sqlGame = "SELECT * FROM game WHERE id_game='".$rowEvents["event_game"]."';";
        $resultGame = mysqli_query($conn, $sqlGame);
        $rowGame = mysqli_fetch_assoc($resultGame);
        $game = $rowGame['game_name'];
        echo '<b>Game:</b> '.$game.'</td>';
        echo '<td><button class="button" type="button" id="viewE'.$rowEvents["id_event"].'" onclick="viewEvent('.$rowEvents["id_event"].')"><img src="../image/eye.svg" class="icon under"/>View</button></td>';
        echo '</td></tr>';
      }
    ?>

    <script>
      checkIfIsLogin();
      function checkIfIsLogin(){
        <?php 
          $isLogin;
          if($_SESSION['id']){ 
            $isLogin =1;
          }else{  
            $isLogin =0;
          } 
        ?>; 
        var isLogin = <?php echo $isLogin; ?>;
        if(isLogin){
          document.getElementById("welcometext").remove();
        }
      }
    </script>
  </body>
</html>