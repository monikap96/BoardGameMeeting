<?php
	session_start();
	include_once 'dbConnection.php';
	if($_SESSION['id']){
		$sqlActualUser= "SELECT * FROM user WHERE id_user=".$_SESSION['id'].";";
		$resultActualUser = mysqli_query($conn, $sqlActualUser);
		while($rowActualUser = mysqli_fetch_assoc($resultActualUser)){
			$actualUserRole = $rowActualUser['user_role'];
		}
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="../js/viewAdminPanelGames.js"></script>
    </head>
<body>
	<div id="nav-placeholder"></div>

	<script>
	$(function(){
	  $("#nav-placeholder").load("navbar.php");
	});
	</script>
	<h1 class="title">Games</h1>
	<?php
		if($_GET['editgame']=="success"){
			echo '<h4 class="info">Game updated.</h4>';
		}else if($_GET['editgame']=="error"){
			echo '<h4 class="error">Error: Game has not been updated.</h4>';
		}else if($_GET['deleteGame']=="success"){
			echo '<h4 class="info">Game deleted.</h4>';
		}else if($_GET['deleteGame']=="error"){
			echo '<h4 class="error">Error: Game has not been deleted.</h4>';
		}
	?>
	<br><br>
	<div class="searchdiv" id="adminGames">
		<img src="../image/search.svg" class="icon"/><input type="text" id="searchGames" value="" onkeyup="searchGames()" placeholder="Search"><br><br>
		<div><label>not yet accepted</label><input type="checkbox" id="notYetAccepted" checked></div>
		<div><label>accepted</label><input type="checkbox" id="accepted" ></div>
		<div><label>neverUsed</label><input type="checkbox" id="neverUsed"></div>
	</div>
	<h3 id="titleOfTable" class="title" value=""></h3>
	<br><br>
	<table id="gamesTable" class="table">
		<tr>
			<th onclick="sortTable(0)" style="min-width:45px;">Id<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(1)" style="min-width:90px;">Name<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th>Image</th>
			<th onclick="sortTable(3)">Accepted<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th>Actions</th>
		</tr><div id="sql" value=""></div>
		<?php
			$sql = "SELECT * FROM game;";
			$result = mysqli_query($conn, $sql);
			
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					echo '<tr>';
					echo '<td>'.$row["id_game"].'</td>';
					echo '<td class="breakWord" style="max-width: 200px;">'.$row["game_name"].'</td>';
					if($row['game_image']==1){
						echo "<td><img class='smallAvatar' src='../games/gameimg".$row['id_game'].".jpg?'".mt_rand()."></td>";
					}else{
						echo "<td><img class='smallAvatar' src='../games/boardgamedefault.png'></td>";
					}
					if($row["game_accepted"]==1){
						echo '<td>'.$row["game_accepted"].'</td>';
					}else if($row["game_accepted"]==0){
						echo '<td>'.$row["game_accepted"].'</td>';
					}else if($row["game_accepted"]==2){
						echo '<td>'.$row["game_accepted"].'</td>';
					}
					echo '<td><button class="button" type="button" id="view'.$row["id_game"].'" onclick="viewGame('.$row["id_game"].')"><img src="../image/eye.svg" class="icon under"/>View</button>';
					if($_SESSION['id']){
						if($actualUserRole == "administrator" || $actualUserRole == "admin"){
							echo '<button class="button" type="button" id="edit'.$row["id_game"].'" onclick="editGame('.$row["id_game"].')"><img src="../image/edit.svg" class="icon under"/>Edit</button>';
							echo '<button class="button delete" type="button" id="delete'.$row["id_game"].'" onclick="deleteGame('.$row["id_game"].')"><img src="../image/trash.svg" class="icon under"/>Delete</button></td>';
						}
					}
					echo '</tr>';
				}
			}
		?>
	</table>
</body>
	<script>
		filterGames();
		document.getElementById("notYetAccepted").addEventListener('change', filterGames);
		document.getElementById("accepted").addEventListener('change', filterGames);
		document.getElementById("neverUsed").addEventListener('change', filterGames);
	</script>
</html>

<?php
	if(!$_SESSION['id']){
		echo '<script type="text/javascript"> forLoggedUsers(); </script>';
	}
?>