<?php
	session_start();
	include_once 'dbConnection.php';
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="../js/viewEventList.js"></script>
    </head>

<body style=" background-image: url('../image/backgr11.jpg');
    background-attachment: fixed;
    background-size: cover;">
	<div id="nav-placeholder"></div>

	<script>
	$(function(){
	  $("#nav-placeholder").load("navbar.php");
	});
	</script>

	<h1 class="title">Events</h1>
	<?php
		if($_GET['error']=="joinFailed"){
			echo '<h4 class="error">>Error: You have not been added to event.</h4>';
		}else if($_GET['error']=="eventNotFound"){
			echo '<h4 class="error">Error: Event not found.</h4>';
		}else if($_GET['createEvent']=="success"){
			echo '<h4 class="info">Event created.</h4>';
		}else if($_GET['error']=="addUsersFailed"){
			echo '<h4 class="error">Error: Users have not been added to event.</h4>';
		}else if($_GET['error']=="createEventFailed"){
			echo '<h4 class="error">Error: Event has not been created.</h4>';
		}else if($_GET['deleteUserFromEvent']=="success"){
			echo '<h4 class="info">User has been deleted from event.</h4>';
		}else if($_GET['error']=="deleteUserFailed"){
			echo '<h4 class="error">Error: User has not been deleted from event.</h4>';
		}else if($_GET['joinEvent']=="success"){
			echo '<h4 class="info">You joined the event.</h4>';
		}else if($_GET['joinEvent']=="error"){
			echo '<h4 class="error">Error: You have not joined the event.</h4>';
		}else if($_GET['event']=="notFound"){
			echo '<h4 class="error">Error: Event does not exist.</h4>';
		}else if($_GET['joinEvent']=="alreadyJoined"){
			echo '<h4 class="error">Error: You have already joined.</h4>';
		}else if($_GET['leaveEvent']=="success"){
			echo '<h4 class="info">You leaved the event.</h4>';
		}else if($_GET['leaveEvent']=="error"){
			echo '<h4 class="error">Error: You have not leaved the event.</h4>';
		}else if($_GET['leaveEvent']=="alreadyLeaved"){
			echo '<h4 class="error">Error: You have already leaved.</h4>';
		}else if($_GET['editedEvent']=="success"){
			echo '<h4 class="info">Event edited.</h4>';
		}else if($_GET['editedEvent']=="error"){
			echo '<h4 class="error">Error: Event has not been edited.</h4>';
		}else if($_GET['error']=="noPermission"){
			echo '<h4 class="error">Error: You have no permission.</h4>';
		}else if($_GET['deleteEvent']=="success"){
			echo '<h4 class="info">Event deleted.</h4>';
		}else if($_GET['deleteEvent']=="deleteEventUsersFailed"){
			echo '<h4 class="error">Error: Event users have not been deleted.</h4>';
		}else if($_GET['deleteEvent']=="deleteRatesUsersFailed"){
			echo '<h4 class="error">Error: Event rates users have not been deleted.</h4>';
		}else if($_GET['deleteEvent']=="deleteEventFailed"){
			echo '<h4 class="error">Error: Event has not been deleted.</h4>';
		}
	?>

	<br>
	<div class="searchdiv">
		<img src="../image/search.svg" class="icon"/><input type="text" id="search" value="" onkeyup="advancedSearch()" placeholder="Search">
		<input type="checkbox" id="showOnlyMyEvents">
		<label>Only my events</label><br><br>
	
		<input type="button" class="button" onclick="advancedDiv()" id="advancedButton" value="advanced search"></input>
	
		<div id="advancedSearch" style="display: none;">
			<div>
				<label>Initiator</label><input type="text" onkeyup="advancedSearch()" id="initiatS"><br>
				<label>Place</label><input type="text" onkeyup="advancedSearch()" id="placeS"><br>
				<label>Date</label><input type="date" onkeyup="advancedSearch()" id="dateS"><br>
				<label>Game</label><input type="text" onkeyup="advancedSearch()" id="gameS"><br>
			</div>
			<div>
				<label>MinPlayers</label><input type="number" onkeyup="advancedSearch()" id="minPlS"><br>
				<label>MaxPlayers</label><input type="number" onkeyup="advancedSearch()" id="maxPlS"><br>
				<label>MinAge</label><input type="number" onkeyup="advancedSearch()" id="minAgeS"><br>
				<label>MaxAge</label><input type="number" onkeyup="advancedSearch()" id="maxAgeS"><br>
			</div>
		</div>
	</div>
	<br><br>

	<table id="eventsTable" class="table">
		<tr>
			<th onclick="sortTable(0)" style="min-width:45px;">Id<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(1)" style="min-width:120px;">Initiator<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(2)" style="min-width: 160px;" >Place<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(3)" style="min-width: 100px;">Date<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th style="min-width:90px;" onclick="sortTable(4)">Game<img src="../image/sort.svg" class="icon" id="sort"/></th>
			<th onclick="sortTable(5)" hidden>Min<br>Players</th>
			<th onclick="sortTable(6)" hidden>Max<br>Players</th>
			<th onclick="sortTable(7)" hidden>Min<br>Age</th>
			<th onclick="sortTable(8)" hidden>Max<br>Age</th>
			<th style="min-width:60px;">Players</th>
			<th style="min-width:60px;">Age</th>
			<th>Users</th>
			<th>Actions</th>
		</tr>
		<?php
			$sql = "SELECT * FROM eventt";
			$result = mysqli_query($conn, $sql);
	
			

			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					$date = date("Y-m-d");
					$time =  date("H:i");
					$eventDate = $row['event_date'];
					$eventTime = $row['event_time'];
					echo '<tr>';
					echo '<td>'.$row["id_event"].'</td>';
					$sql1 = "SELECT * FROM user WHERE id_user='".$row['event_initiator']."';";
					$result1 = mysqli_query($conn, $sql1);
					while($row1 = mysqli_fetch_assoc($result1)){
						if($row1['user_avatar']==1){
							echo '<td>';
							echo "<img class='smallAvatar' src='../avatars/profile".$row1['id_user'].".jpg?'".mt_rand()."><br>";
							echo $row1["user_login"].'</td>';
						}else{
							echo '<td>';
							echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'><br>";
							echo $row1["user_login"].'</td>';
						}
					}
					echo '<td class="breakWord"  style="max-width: 300px;">'.$row["event_place"].'</td>';
					$timeOfEvent = date('H:i', strtotime($row["event_time"]));
					echo '<td>'.$row["event_date"].'<br>'.$timeOfEvent.'</td>';
					
					$sqlGame = "SELECT * FROM game WHERE id_game='".$row['event_game']."';";
					$resultGame = mysqli_query($conn, $sqlGame);
					while($rowGame = mysqli_fetch_assoc($resultGame)){
						echo '<td class="breakWord" style="max-width: 200px;">'.$rowGame["game_name"].'</td>';
					}
					echo '<td hidden>'.$row["event_min_players"].'</td>';
					echo '<td hidden>'.$row["event_max_players"].'</td>';
					echo '<td hidden>'.$row["event_min_age"].'</td>';
					echo '<td hidden>'.$row["event_max_age"].'</td>';
					echo '<td>'.$row["event_min_players"].'-'.$row["event_max_players"].'</td>';
					echo '<td>'.$row["event_min_age"].'-'.$row["event_max_age"].'</td>';
					echo '<td>';
					$sql2 = "SELECT * FROM event_user WHERE id_event='".$row['id_event']."' AND (priorityy=1 OR priorityy=2) ORDER BY priorityy ASC;";
					$result2 = mysqli_query($conn, $sql2);
					$actualUserIsInEvent = false;
					$priorityy="";
					while($row2 = mysqli_fetch_assoc($result2)){
						$sql3 = "SELECT id_user, user_login, user_avatar FROM user WHERE id_user='".$row2['id_user']."';";
						$result3 = mysqli_query($conn, $sql3);
						while($row3 = mysqli_fetch_assoc($result3)){
							if($row2['priorityy']==2){
								echo "<div class='imgUsername notAccepted'>";
							}else{
								echo "<div class='imgUsername'>";
							}
							
							if($row3['user_avatar']==1){
								echo "<img class='smallAvatar' src='../avatars/profile".$row3['id_user'].".jpg?'".mt_rand().">";
								echo "<label>".$row3["user_login"]."</label></div>";
							}else{
								echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
								echo "<label>".$row3["user_login"]."</label></div>";
							}
							if($row3['id_user']==$_SESSION['id']){
								$actualUserIsInEvent = true;
								$priorityy = $row2['priorityy'];
							}
						}
					}
					echo '</td>';
					echo '<td>';
					if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
						if(!$actualUserIsInEvent){
							if($_SESSION['id']){
								echo '<button class="button join" type="button" id="joinE'.$row["id_event"].'" onclick="joinEvent('.$row["id_event"].')"><img src="../image/plus.svg" id="plus" class="icon under"/>Join</button>';
							}
						}else{
							if($_SESSION['id']!=$row['event_initiator']){
								if($priorityy==2){
									echo '<button class="button join" type="button" id="joinE'.$row["id_event"].'" onclick="joinEvent('.$row["id_event"].')"><img src="../image/plus.svg" id="plus" class="icon under"/>Accept</button>';
									echo '<button class="button leave" type="button" id="declineE'.$row["id_event"].'" onclick="declineEvent('.$row["id_event"].')"><img src="../image/minus.svg" id="minus" class="icon under"/>Decline</button>';
								}else if($priorityy==1){
									echo '<button class="button leave" type="button" id="leaveE'.$row["id_event"].'" onclick="leaveEvent('.$row["id_event"].')"><img src="../image/minus.svg" id="minus" class="icon under"/>Leave</button>';
								}else{
									echo '<button class="button leave" type="button" id="leaveE'.$row["id_event"].'" onclick="leaveEvent('.$row["id_event"].')"><img src="../image/minus.svg" id="minus" class="icon under"/>Leave</button>';
								}
							}
						}
					}
					echo '<button class="button view" type="button" id="viewE'.$row["id_event"].'" onclick="viewEvent('.$row["id_event"].')"><img src="../image/eye.svg" class="icon under"/>View</button>';
					if($_SESSION['id']==$row['event_initiator']){
						if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
							echo '<button class="button edit" type="button" id="editE'.$row["id_event"].'"  onclick="editEvent('.$row["id_event"].')"><img src="../image/edit.svg" class="icon under"/>Edit</button>';
							echo '<button class="button delete" type="button" id="deleteE'.$row["id_event"].'"  onclick="deleteEvent('.$row["id_event"].')"><img src="../image/trash.svg" class="icon under"/>Delete</button></td>';
						}else{
							echo '<button class="button disabled" type="button" id="editE'.$row["id_event"].'"  onclick="editEvent('.$row["id_event"].')"><img src="../image/edit.svg" class="icon under"/>Edit</button>';
							echo '<button class="button disabled" type="button"><img src="../image/trash.svg" class="icon under"/>Delete</button></td>';
						}
					}
					echo '</tr>';
				}
			}
		?>
	</table>
</body>
	<script>
		document.getElementById("dateS").addEventListener('change', advancedSearch);
		document.getElementById("showOnlyMyEvents").addEventListener('change', advancedSearch);

		function advancedSearch(){
			var filter = document.getElementById("search").value.toUpperCase();
			var checkboxOnlyMyEvent = document.getElementById("showOnlyMyEvents").checked;
			var actualUserLogin = "<?php echo $_SESSION['login']; ?>";

			var input = [];
			input[1] = document.getElementById("initiatS").value.toUpperCase();
			input[2] = document.getElementById("placeS").value.toUpperCase();
			input[3] = document.getElementById("dateS").value.toUpperCase();
			input[4] = document.getElementById("gameS").value.toUpperCase();
			input[5] = document.getElementById("minPlS").value;
			input[6] = document.getElementById("maxPlS").value;
			input[7] = document.getElementById("minAgeS").value;
			input[8] = document.getElementById("maxAgeS").value;
			var table, tr, td, i, j, txtValue;
			table = document.getElementById("eventsTable");
			tr = table.getElementsByTagName("tr");
			
			for (i = 0; i < tr.length; i++) {
				for(j=1; j<10; j++){
					if(j>=1 && j<=4){
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
					}else if((j==5 || j==7)&& input[j]!=""){
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
					}else if((j==6 || j==8)&& input[j]!=""){
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
			if(checkboxOnlyMyEvent){
				for (i = 0; i < tr.length; i++) {
					if(tr[i].style.display == ""){
						td = tr[i].getElementsByTagName("td")[1];
						if (td) {
							if (td.textContent==actualUserLogin) {
								tr[i].style.display = "";
							} else {
								tr[i].style.display = "none";
							}
						}     
					}  
				}
			}else{
				for (i = 0; i < tr.length; i++) {
					if(tr[i].style.display == ""){
						td = tr[i].getElementsByTagName("td")[1];
						if (td) {
							tr[i].style.display = "";
						}
					}
				}
			}
		}
	</script>
</html>