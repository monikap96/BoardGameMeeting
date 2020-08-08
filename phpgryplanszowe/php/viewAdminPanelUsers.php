<?php
	session_start();
	include_once 'dbConnection.php';

	$sqlActualUser= "SELECT * FROM user WHERE id_user=".$_SESSION['id'].";";
	$resultActualUser = mysqli_query($conn, $sqlActualUser);
	while($rowActualUser = mysqli_fetch_assoc($resultActualUser)){
		$actualUserRole = $rowActualUser['user_role'];
	}
?>

<html>
	<head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="../js/viewAdminPanelUsers.js"></script>
	</head>
	<body>
		<div id="nav-placeholder"></div>

		<script>
			$(function(){
			$("#nav-placeholder").load("navbar.php");
			});
		</script>
		<h1 class="title">Users</h1>

		<br>
		<?php
			if($_GET['activate']=="success"){
				echo '<h4 class="info">User activated.</h4>';
			}else if($_GET['activate']=="error"){
				echo '<h4 class="error">Error: User has not been activated.</h4>';
			}else if($_GET['changeRole']=="success"){
				echo '<h4 class="info">User role changed.</h4>';
			}else if($_GET['changeRole']=="error"){
				echo '<h4 class="error">Error: User role has not been changed.</h4>';
			}else if($_GET['changeRole']=="noPermission"){
				echo '<h4 class="error">Error: You have no permission.</h4>';
			}
		?>

		<br>
		<div class="searchdiv" id="adminUserList">
			<img src="../image/search.svg" class="icon"/><input type="text" id="search" value="" onkeyup="advancedSearch()" placeholder="Search">
			<input type="button" class="button" onclick="advancedDiv()" id="advancedButton" value="advanced search"></input>

			<div id="advancedSearch" style="display: none;">
				<div>
					<label>username</label><input type="text" onkeyup="advancedSearch()" id="userNameS"><br>
					<label>email</label><input type="text" onkeyup="advancedSearch()" id="emailS"><br>
					<label>role</label>
					<select id="roleS">
						<option value="" selected>All</option>
						<option value="administrator">administrator</option>
						<option value="admin">Admin</option>
						<option value="role">User</option>
					</select><br>
					<label>activated</label>
					<select id="activatedS">
						<option value="" selected>All</option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select><br>
				</div>
			</div>
		</div>
		<br><br>
		<table class="table" id="usersTable">
			<tr>
				<th onclick="sortTable(0)">Id<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(1)" style="max-width:180px;">Username<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(2)" style="max-width:160px;">Email<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(3)" style="max-width:160px;">Role<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(4)" style="max-width:80px;">Score<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(5)" style="max-width:130px;">Activated<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th>Actions</th>
			</tr>
			<?php
				$sql = "SELECT * FROM user";
					
				$result = mysqli_query($conn, $sql);
				$countedRows = mysqli_num_rows($result);
				
				if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_assoc($result)){

						$sqlRoundAvgRate = "SELECT ROUND(AVG(score),2) AS avg_rate FROM user_score WHERE id_rated_user=".$row['id_user'].";";
						$resultRoundAvgRate = mysqli_query($conn, $sqlRoundAvgRate);
						$rowAvgRate= mysqli_fetch_assoc($resultRoundAvgRate);
						echo '<tr>';
						echo '<td>'.$row["id_user"].'</td>';
						echo '<td>';
						if($row['user_avatar']==1){
							echo "<img class='smallAvatar' src='../avatars/profile".$row['id_user'].".jpg?'".mt_rand()."><br>";
						}else{
							echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'><br>";
						}
						echo $row["user_login"].'</td>';
						echo '<td>'.$row["user_email"].'</td>';
						echo '<td>'.$row["user_role"].'</td>';
						echo '<td>'.$rowAvgRate['avg_rate'].'</td>';
						echo '<td>'.$row["user_activated"].'</td>';
						echo '<td><button class="button" type="button" id="changeRole'.$row["id_user"].'" onclick="changeRole('.$row["id_user"].')">Change role</button>';
						if($row['user_activated']==0){
							echo '<button class="button" type="button" id="activated'.$row["id_user"].'" onclick="activateUser('.$row["id_user"].')">Activate</button></td>';
						}else{
							echo '<button class="button" type="button" id="disactivated'.$row["id_user"].'" onclick="disactivateUser('.$row["id_user"].')">Disactivate</button></td>';
						}
						echo '</tr>';
					}
				}
			?>

		</table>
		<div id="myModal" class="modal">
			<div class="modal-content">
				<span class="close" id="rolespan">&times;</span><br>
				<form id="formChangeRole" action="updateUserRole.php" method="POST">
					<label class="label2">Change role user id</label>
					<input class="inputForm" type="text" id="chosenUser" name="chosenUser" value="" style="border: none;" readonly required>
					<br>
					<select id="roles" name="roles">
						<?php 
							if($actualUserRole == "admin"){
								echo '<option value="admin">Admin</option>';
								echo '<option value="user">User</option>';
							}else if($actualUserRole == "administrator"){
								echo '<option value="administrator">Administrator</option>';
								echo '<option value="admin">Admin</option>';
								echo '<option value="user">User</option>';
							}
							?>
					</select>
					<input class="button" type="submit" name="submit" value="Save">
				</form>
			</div>
		</div>
	<script>
		document.getElementById("roleS").addEventListener('change', advancedSearch);
		document.getElementById("activatedS").addEventListener('change', advancedSearch);
	</script>
	</body>
</html>