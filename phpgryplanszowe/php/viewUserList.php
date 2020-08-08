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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="../js/viewUserList.js"></script>
	</head>
	<body style=" background-image: url('../image/backgr9.jpg');
    background-attachment: fixed;
    background-size: cover;">
		<div id="nav-placeholder"></div>

		<script>
			$(function(){
			$("#nav-placeholder").load("navbar.php");
			});
		</script>
		<h1 class="title">Users</h1>


		<br>
		<div class="searchdiv" id="userList">
			<img src="../image/search.svg" class="icon"/><input type="text" id="search" value="" onkeyup="advancedSearch()" placeholder="Search"><br><br>
			<input type="button" class="button" onclick="advancedDiv()" id="advancedButton" value="advanced search">
			<div id="advancedSearch" style="display: none;">
				<div>
					<label>username</label><input type="text" onkeyup="advancedSearch()" id="userNameS"><br>
					<label>role</label>
					<select id="roleS">
						<option value="" selected>All</option>
						<option value="administrator">administrator</option>
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select><br>
					<label>min rate</label><input type="text" onkeyup="advancedSearch()" id="minRateS"><br>
					<label>max rate</label><input type="text" onkeyup="advancedSearch()" id="maxRateS"><br>
				</div>
			</div>
		</div>
		<br><br>
		<table class="table" id="usersTable">
			<tr>
				<th onclick="sortTable(0)" style="width:45px;">Id<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(1)">Username<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(2)" style="max-width:160px;">Role<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th onclick="sortTable(3)">Score<img src="../image/sort.svg" class="icon" id="sort"/></th>
				<th style="width:65px;">Actions</th>
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
						echo '<td>'.$row["user_role"].'</td>';
						echo '<td>'.$rowAvgRate['avg_rate'].'</td>';
						echo '<td><button class="button" type="button" id="view'.$row["id_user"].'" onclick="viewUser('.$row["id_user"].')"><img src="../image/eye.svg" class="icon under"/>View</button>';
						echo '</tr>';
					}
				}
			?>
		</table>
	</body>
	<script>
		document.getElementById("roleS").addEventListener('change', advancedSearch);
	</script>
</html>