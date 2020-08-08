<?php
  session_start();
  include_once 'dbConnection.php'; 
  $actualUserId = $_SESSION['id'];

  if($actualUserId){
    $sql = "SELECT * FROM user WHERE id_user=".$actualUserId.";";
    $result = mysqli_query($conn, $sql);
    $row= mysqli_fetch_assoc($result);

    $sqlCountNotif = "SELECT COUNT(id_notif) as countt FROM notificationn WHERE id_user=".$actualUserId." AND notif_read=0;";
    $resultCountNotif = mysqli_query($conn, $sqlCountNotif);
    $rowCountNotif= mysqli_fetch_assoc($resultCountNotif);
  }
?>
<!DOCTYPE html>
<html>
  
  <head>
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
    <link rel="preload" href="../image/eye.svg" as="image" media="(max-width: 50px)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/navbar.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style> 
  * {box-sizing: border-box;}
  </style>
  <body>
    <div id="mynavbar" class="navbar"> 
        <button class="dropbtn respons" id="bgm"  onclick="window.location.href='homePage.php';"><img src="../image/logo.png" id="logo"/>
          <label>BoardGameMeeting</label>
        </button>
        <div class="navright" id="pnavright" style="float: right;">
          <div class="dropdown imgicons">
            <button class="dropbtn respons" onclick="showEventList()"><img src="../image/event.svg" class="iconNav"/><label>Events</label></button>
              <div id="eventList" class="divdropdownlist">
                <div id="createEvent"><a class="anavbar" href="formCreateEvent.php" >Create event</a><br></div>
                <div id="withMeEvent"><a class="anavbar" href="viewEventListWithMe.php">Events With Me</a><br></div> 
                <a class="anavbar" href="viewEventList.php">All events</a>
              </div>
          </div>
          <div class="dropdown imgicons" >
            <button class="dropbtn respons" onclick="showGameList()"><img src="../image/game.svg" class="iconNav"/><label>Games</label></button>
              <div id="gameList" class="divdropdownlist">    
                <div id="createGame"><a class="anavbar" href="formCreateGame.php">Create game</a><br></div>
                <a class="anavbar" href="viewGameList.php">All games</a>
              </div>
          </div>
          <div class="dropdown imgicons" >
            <button class="dropbtn respons" onclick="showUserList()"><img src="../image/user.svg" class="iconNav"/><label>Users</label></button>
              <div id="userList" class="divdropdownlist">    
                <a class="anavbar" href="viewUserList.php">All users</a>
              </div>
          </div>
          <div class="dropdown imgicons" id="foradm">
            <button id="forAdmins" class="dropbtn respons" onclick="showUserListAdmin()"><img src="../image/admin.svg" class="iconNav"/><label>Admin</label></button> 
              <div id="userListAdmin" class="divdropdownlist">    
                <a class="anavbar" href="viewAdminPanelGames.php">All games</a><br>
                <a class="anavbar" href="viewAdminPanelUsers.php">All users</a>
              </div>
          </div>
          <div class="dropdown imgicons"  id="notifDiv">
            <button class="dropbtn respons" onclick="showNotif()"><img src="../image/ring1.svg" class="iconNav"/>
              <label id="notif" >
                <?php if($rowCountNotif['countt']!=0) {echo $rowCountNotif['countt'];}?>
              </label>
            </button>
            <div id="notifList" class="divdropdownlist scrollbar">
            </div>
          </div>
          <div class="dropdown" id="forUser1">
            <button id="profileButton" class="dropbtn respons" onclick="showProfileList()">
            <?php
              if($actualUserId){
                if($row['user_avatar']==1){
                  echo "<div class='imgUsernameCenter imgicons'><img class='smallAvatar' src='../avatars/profile".$actualUserId.".jpg?'".mt_rand().">";
                  echo "<label>".$_SESSION['login']."</label></div>";
                }else{
                  echo "<div class='imgUsernameCenter imgicons'><img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
                  echo "<label>".$_SESSION['login']."</label></div>";
                }
              } 
            ?>
            </button>
              <div id="profileList" class="divdropdownlist">    
                <a class="anavbar" href="viewActualUserProfile.php">My profile</a><br>
                <a class="anavbar" href="editAccountSettings.php">Settings</a>
              </div>
          </div>
          <button class="dropbtn respons" id="forUser2" onclick="window.location.href='dbLogout.php';"><img src="../image/sign-out.svg" class="iconNav"/><label>Logout</label></button>
          <button class="dropbtn respons" id="forGuest2" onclick="window.location.href='formRegister.php';"><img src="../image/sign-out.svg" class="iconNav"/><label>Register</label></button>     
          <button class="dropbtn respons" id="forGuest1" onclick="window.location.href='formLogin.php';"><img src="../image/sign-in.svg" class="iconNav"/><label>Login</label></button>
        </div>
      
    </div> 
    <div id="notifModal" class="modal">
			<div class="modal-content">
				<span class="close" id="notifspan">&times;</span>
					<input class="inputForm" type="hidden" id="notifId" name="notifId" value="" >
          <input class="inputForm" type="hidden" id="url" name="url" value="" >
					<div id="notifText"></div>
          <button class="button view" type="button" style="margin: auto; display: block;" id="viewAnEvent" onclick="viewEvent(this.id)"><img src="../image/eye.svg" class="icon under"/>View</button>
			</div>
    </div>

      
    <script>
      $("#notifList").load("loadNotif.php");
    </script>
  </body>
</html>

<?php 
  if($_SESSION['login']==""){
    echo '<script type="text/javascript"> wyloguj(); </script>';
  }else{
    echo '<script type="text/javascript"> loguj(); </script>';
    $sqlActualUser = "SELECT * FROM user WHERE id_user=".$actualUserId.";";
    $resultActualUser = mysqli_query($conn, $sqlActualUser);
    $rowActualUser = mysqli_fetch_assoc($resultActualUser);
    $actualUserRole = $rowActualUser['user_role'];
    if($actualUserRole=="administrator" || $actualUserRole=="admin"){
      echo '<script type="text/javascript"> forAdmins(); </script>';
    }else{
      echo '<script type="text/javascript"> forUsers(); </script>';
    }
  }
?>
