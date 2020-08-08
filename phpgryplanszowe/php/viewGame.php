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
        $gameId = $_GET["gid"];
        $sql = "SELECT * FROM game WHERE id_game=".$gameId."";
				
			$result = mysqli_query($conn, $sql);
			$countedRows = mysqli_num_rows($result);
			
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
          echo '<h1 class="title breakWord" style="max-width: 700px; margin: auto;">'.$row["game_name"].'</h1>';
					echo '<div class="viewDetails" style="display: flex;">';
          echo '<div>';
          if($row['game_image']==1){
            echo "<img class='gameImage' src='../games/gameimg".$row['id_game'].".jpg?'".mt_rand().">";
          }else{
            echo "<img class='gameImage' src='../games/boardgamedefault.png'>";
          }
          echo '</div>';
          echo '<div style="width: 400px; padding: 30px;">';
					echo '<label><b>Players:</b> '.$row["game_min_players"].' - '.$row["game_max_players"].'</label><br>';
					echo '<label><b>Age:</b> '.$row["game_min_age"].' - '.$row["game_max_age"].'</label><br>';
          echo '<label><b>Description: </b></label><br><label class="breakWord" style="max-width: 400px;">'.$row["game_description"].'</label><br>';
          echo '</div>';
          echo '</div>';
          
          
          echo '<div class="centerdiv" style="display: flex;">';
					if($_SESSION['id']){
            $user = "SELECT * FROM user WHERE id_user=".$_SESSION['id']."";
            $resultUser = mysqli_query($conn, $user);
            while($rowUser = mysqli_fetch_assoc($resultUser)){
              $role = $rowUser['user_role'];
              if($role=="administrator" || $role=="admin"){
                if($row['game_accepted']==0 || $row['game_accepted']==2){
                  echo '<button class="button" type="button" onclick="acceptGame()">Accept</button>';
                }else{
                  echo '<button class="button" type="button" disabled>Accepted</button>';
                }
                echo '<button class="button" type="button" onclick="editGame()">Edit</button>';
              }
            }
          }
          echo '</div>';
				}
			}else{
        echo "Game not found";
      }
        ?>

      <script>
        function acceptGame(){
          window.location.href = 'acceptGame.php?gid='+<?php echo $gameId;?>+'';			
        }
        function editGame(){
          window.location.href = 'editGame.php?gid='+<?php echo $gameId;?>+'';
        }
      </script>
        
    </body> 
</html>