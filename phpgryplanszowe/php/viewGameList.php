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
		<script type="text/javascript" src="../js/viewGameList.js"></script>
    </head>

<body style=" background-image: url('../image/backgr10.jpg');
    background-attachment: fixed;
    background-size: cover;">
	<div id="nav-placeholder"></div>

	<script>
	$(function(){
	  $("#nav-placeholder").load("navbar.php");
	});
	</script>
	<h1 class="title">Games</h1>
	<?php
		if($_GET['createGame']=="success"){
			echo '<h4 class="info">Game created. The game is waiting for acceptance.</h4>';
		}else if($_GET['createGame']=="error"){
			echo '<h4 class="error">Error: Game has not been created.</h4>';
		}
	?>
	<div class="searchdiv">
	<img src="../image/search.svg" class="icon"/><input type="text" id="searchGames" value="" onkeyup="advancedSearch()" placeholder="Search"><br><br>
	
		<input type="button" class="button" onclick="advancedDiv()" id="advancedButton" value="advanced search"></input><br><br>
	
		<div id="advancedSearch" style="display: none;">
			<div>
				<label>Name</label><input type="text" onkeyup="advancedSearch()" id="nameS"><br>
				<label>MinPlayers</label><input type="number" onkeyup="advancedSearch()" id="minPlS"><br>
				<label>MaxPlayers</label><input type="number" onkeyup="advancedSearch()" id="maxPlS"><br>
				<label>MinAge</label><input type="number" onkeyup="advancedSearch()" id="minAgeS"><br>
				<label>MaxAge</label><input type="number" onkeyup="advancedSearch()" id="maxAgeS"><br>
			</div>
		</div>
	</div>
	<br><br>
	<table id="gamesTable" class="table">
		<tr>
			<th onclick="sortTable(0)" style="min-width:45px;">Id<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(1)" style="width:200px;">Name<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(2)" style="max-width:75px;">Min <img src="../image/sort.svg" class="icon" id="sort"/>Players</th>
			<th onclick="sortTable(3)" style="max-width:75px;">Max <img src="../image/sort.svg" class="icon" id="sort"/>Players</th>
			<th onclick="sortTable(4)" style="width:75px;"><div style="display: inline-flex;">Min<br>Age</div><img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(5)" style="width:75px;"><div style="display: inline-flex;">Max<br>Age</div><img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th>Image</th>
			<th>Actions</th>
		</tr>
		<?php
			include_once 'dbConnection.php';
			$sql = "SELECT * FROM game WHERE game_accepted=1;";
				
			$result = mysqli_query($conn, $sql);
			
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					echo '<tr>';
					echo '<td>'.$row["id_game"].'</td>';
					echo '<td class="breakWord" style="max-width: 200px;">'.$row["game_name"].'</td>';
					echo '<td>'.$row["game_min_players"].'</td>';
					echo '<td>'.$row["game_max_players"].'</td>';
					echo '<td>'.$row["game_min_age"].'</td>';
					echo '<td>'.$row["game_max_age"].'</td>';
					if($row['game_image']==1){
						echo "<td><img class='smallAvatar' src='../games/gameimg".$row['id_game'].".jpg?'".mt_rand()."></td>";
					}else{
						echo "<td><img class='smallAvatar' src='../games/boardgamedefault.png'></td>";
					}
					echo '<td><button class="button" type="button" id="view'.$row["id_game"].'" onclick="viewGame('.$row["id_game"].')"><img src="../image/eye.svg" class="icon under"/>View</button>';
					echo '</tr>';
				}
			}
		?>
	</table>
</body>
	<script>
		function advancedSearch(){
			var filter = document.getElementById("searchGames").value.toUpperCase();
			var actualUserLogin = "<?php echo $_SESSION['login']; ?>";

			var input = [];
			input[1] = document.getElementById("nameS").value.toUpperCase();
			input[2] = document.getElementById("minPlS").value;
			input[3] = document.getElementById("maxPlS").value;
			input[4] = document.getElementById("minAgeS").value;
			input[5] = document.getElementById("maxAgeS").value;
			var table, tr, td, i, j, txtValue;
			table = document.getElementById("gamesTable");
			tr = table.getElementsByTagName("tr");
			
			for (i = 0; i < tr.length; i++) {
				for(j=1; j<6; j++){
					if(j==1){
						td = tr[i].getElementsByTagName("td")[j];
						if (td) {
							txtValue = td.textContent || td.innerText;
							if (txtValue.toUpperCase().indexOf(input[j]) > -1) {
								tr[i].style.display = "";
							} else {
								tr[i].style.display = "none";
								break;
							}
						}      
					}else if((j==2 || j==3)&& input[j]!=""){
						td = tr[i].getElementsByTagName("td")[j];
						td2 = tr[i].getElementsByTagName("td")[j+1];
						if(td && input[j]!=""){
							txtValue = td.textContent || td.innerText;
							txtValue2 = td2.textContent || td2.innerText;
							if(parseInt(input[j])>=parseInt(txtValue) && parseInt(input[j])<=parseInt(txtValue2)){
								tr[i].style.display = "";
							}else {
								tr[i].style.display = "none";
								break;
							}
						}
					}else if((j==4 || j==5)&& input[j]!=""){
						td = tr[i].getElementsByTagName("td")[j];
						td2 = tr[i].getElementsByTagName("td")[j-1];
						if(td && input[j]!=""){
							txtValue = td.textContent || td.innerText;
							txtValue2 = td2.textContent || td2.innerText;
							if(parseInt(input[j])<=parseInt(txtValue) && parseInt(input[j])>=parseInt(txtValue2)){
								tr[i].style.display = "";
							}else {
								tr[i].style.display = "none";
								break;
							}
						}
					}
				}
			}
			for (i = 0; i < tr.length; i++){
				if(tr[i].style.display == ""){
					for(j=1; j<11; j++){
						td = tr[i].getElementsByTagName("td")[j];
						if (td && filter!="") {
							txtValue = td.textContent || td.innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
								break;
							} else {
								tr[i].style.display = "none";
							}
						}       
					}
				}
			}
		}
	</script>
</html>