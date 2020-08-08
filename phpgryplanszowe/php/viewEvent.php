<?php
	session_start();
	include_once 'dbConnection.php';
	if($_SESSION['login']){
		$loginValue = $_SESSION['login'];
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>

<body>
	<div id="nav-placeholder"></div>
	<script>
		var from = null, start = 0;
		$(document).ready(function(){
			from = "<?php echo $loginValue; ?>";
			if (from){
				load();
				var eventId = '<?php echo $_GET["evid"]; ?>';
				$('#formMessage').submit(function(){
					$.post('dbAddMessageToChat.php', {
						chatMessage: $('#chatMessage').val(),
						from: from,
						eventId: eventId
					});
					$('#chatMessage').val('');
					return false;
				});

				$("#chatMessage").keydown(function(e){
					if(e.which == 13 && !e.shiftKey){
						$.post('dbAddMessageToChat.php', {
							chatMessage: $('#chatMessage').val(),
							from: from,
							eventId: eventId
						});
						$('#chatMessage').val('');
						return false;
					}
				});
			}
		});

		function load(){
			var eventId = '<?php echo $_GET["evid"]; ?>';
			$.get('dbAddMessageToChat.php' + '?start='+start + '&evid='+eventId , function(result){
				if(result.items){
					result.items.forEach(item =>{
						start = item.id_chat;
						$('#messages').append(renderMessage(item));
					});
					$('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
				};
			});
		} 

		$(document).ready(function () {
			setInterval(function () {
				load();
			}, 3000);
		});

		function renderMessage(item){
			let time = new Date(item.created_time);
			let day, month, date;
			from = "<?php echo $loginValue; ?>";

			if(time.getMonth()<10){
				month='0'+time.getMonth();
			}else{
				month=time.getMonth();
			}
			if(time.getDate()<10){
				day='0'+time.getDate();
			}else{
				day=time.getDate();
			}
			date = time.getFullYear()+'.'+month+'.'+day;
			if(time.getHours()<10){
				hour='0'+time.getHours();
			}else{
				hour=time.getHours();
			}
			if(time.getMinutes()<10){
				minutes='0'+time.getMinutes();
			}else{
				minutes=time.getMinutes();
			}
			time =hour+':'+minutes;

			if(item.user_login==from){
			return '<div class="msgs"><div class="mymsg"><span id="username">'+item.user_login+'</span><br><span id="date">'+date+'</span><span id="time"> '+time+'</span><br><span id="textmessage">'+item.text_message+'</span></div></div>';
			}else{
			return '<div class="msgs"><div class="msg"><span id="username">'+item.user_login+'</span><br><span id="date">'+date+'</span><span id="time"> '+time+'</span><br><span id="textmessage">'+item.text_message+'</span></div></div>';
			}
		}
	</script>

		<div id="ratingModal" class="modal">
			<div class="modal-content">
				<span class="close" id="ratespan">&times;</span>
				<form id="formRateUser" name="formRateUser" action="ratingUser.php" method="POST">
					<input class="inputForm" type="hidden" id="actualEvent" name="actualEvent" value="<?php echo $_GET["evid"];?>" >
					<input class="inputForm" type="hidden" id="chosenUser" name="chosenUser" value="" >
					<label class="label2">Rate user </label>
					<br>
					<select id="rates" name="rates">
						<option value="0"></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<input class="button" type="submit" name="submitR" value="Save"/>
				</form>
			</div>
		</div>

	<script>
	$(function(){
	  $("#nav-placeholder").load("navbar.php");
	});
	
		function eventNotFound(){
			window.location.href = 'viewEventList.php?event=notFound';
		}
	</script>
	<?php
		$eventId = $_GET["evid"];
	
		$sql = "SELECT * FROM eventt WHERE id_event='".$eventId."';";
		$result = mysqli_query($conn, $sql);
		$maxPlayers="";
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$maxPlayers = $row['event_max_players'];
				echo '<h1 class="title">Event id='.$row["id_event"].' </h1>';
				echo '<div style="width: 300px" class="inlinediv">';
				
				$evTime = date('H:i', strtotime($row["event_time"]));
				echo '<h4>Date and Time: <br>'.$row["event_date"].' &emsp; '.$evTime.'</h4>';
				$sql1 = "SELECT * FROM user WHERE id_user='".$row['event_initiator']."';";
				$result1 = mysqli_query($conn, $sql1);
				while($row1 = mysqli_fetch_assoc($result1)){
					$initiator = $row1["user_login"]; 
					echo '<h4>Initiator: '.$initiator.'</h4>';
				}
				echo '<h4 class="breakWord">Place: '.$row["event_place"].'</h4>';

				$sqlGame = "SELECT * FROM game WHERE id_game='".$row['event_game']."';";
				$resultGame = mysqli_query($conn, $sqlGame);
				while($rowGame = mysqli_fetch_assoc($resultGame)){
					echo '<h4>Game: '.$rowGame["game_name"].'</h4>';
				}
				
				echo '<h4>Players: '.$row["event_min_players"].' - '.$row["event_max_players"].'</h4>';
				echo '<h4>Age: '.$row["event_min_age"].' - '.$row["event_max_age"].'</h4>';
			}
			echo '</div>';
			echo '<div style="width: 400px; margin-left: 300px;" class="inlinediv">';
			$sqlIsInEvent = "SELECT * FROM event_user WHERE id_event='".$eventId."' AND id_user='".$_SESSION['id']."';";
			$resultIsInEvent = mysqli_query($conn, $sqlIsInEvent);
			$canRate = false;
			if($actualUserIfcanRate = mysqli_fetch_assoc($resultIsInEvent)){
				if($actualUserIfcanRate['priorityy']==1){
					$canRate=true;
				}
			}
			if(mysqli_num_rows($resultIsInEvent)>0){
				echo '<h3>Chat</h3>';
				echo '<div id="messages" class="scrollbar eventChat">';
				echo '</div>';
				echo '<div id="messageform">';
				echo '<form id="formMessage">';
				echo '<textarea cols="85" rows="25" id="chatMessage" autocomplete="off"  placeholder="Type message..."></textarea>';
				echo '<input type="submit" id="messageSend" class="button" value="Send">';
				echo '</form>';
				echo '</div>';
			}else{
				echo '<div id="nomessages">';
				echo '<h4>You must be an event member to view the chat</h4>';
				echo '</div>';
			}
			echo '</div>';
			

			echo '<div style="width: 350px; margin-left: 750px;" class="inlinediv">';
			echo '<h4>Event Users</h4>';
				$sqlIdUsers = "SELECT * FROM event_user WHERE id_event='".$eventId."' ORDER BY priorityy ASC;";
				$resultIdUsers = mysqli_query($conn, $sqlIdUsers);
				$allUsersInEvent = "";
				$numOfRows = mysqli_num_rows($resultIdUsers);
				$count = $numOfRows;
				$rowNumber = 1;
				$isInterested=false;
				
				while($rowIdUsers = mysqli_fetch_assoc($resultIdUsers)){
					if($count>1){
						$allUsersInEvent = $allUsersInEvent."'".$rowIdUsers['id_user']."',";
					}else{
						$allUsersInEvent = $allUsersInEvent."'".$rowIdUsers['id_user']."'";
					}
					$sqlNameUsers = "SELECT id_user, user_login, user_avatar  FROM user WHERE id_user='".$rowIdUsers['id_user']."';";
					$resultNameUsers = mysqli_query($conn, $sqlNameUsers);
			
					$sql = "SELECT * FROM eventt WHERE id_event='".$eventId."';";
					$result = mysqli_query($conn, $sql);
					
					if(mysqli_num_rows($result)>0){
						while($row = mysqli_fetch_assoc($result)){
							$date = date("Y-m-d");
							$time =  date("H:i:s");
							$eventDate = $row['event_date'];
							$eventTime = $row['event_time'];
							$startTime = date('H:i:s', strtotime($eventTime.'+2 hours'));
							$endDate = date('Y-m-d', strtotime("+7 days", strtotime($eventDate)));
						}
					}
					
					while($rowNameUsers = mysqli_fetch_assoc($resultNameUsers)){
						if(!$isInterested){
							if($rowIdUsers['priorityy']==3){
								echo '<h4>Interested Users</h4>';
								$isInterested = true;
							}
						}
						if($_SESSION['id']){
							$sqlFindRateIfExist = "SELECT * FROM user_score WHERE id_event=".$eventId." AND id_rated_by_user=".$_SESSION['id']." AND id_rated_user=".$rowNameUsers['id_user'].";";
							$resultFindRateIfExist = mysqli_query($conn, $sqlFindRateIfExist);
							$rowFindRateIfExist = mysqli_fetch_assoc($resultFindRateIfExist);
						}
						
						if($initiator == $loginValue){
							if($rowIdUsers["id_user"] == $_SESSION['id']){
								if($rowNameUsers['user_avatar']==1){
									echo "<div class='imgUsername'><img class='smallAvatar' src='../avatars/profile".$rowIdUsers['id_user'].".jpg?'".mt_rand().">";
								}else{
									echo "<div class='imgUsername'><img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
								}
								echo '<label>'.$rowNameUsers["user_login"].'</label></div>';
							}else{
								if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
									if($rowIdUsers['priorityy']==2){
										echo '<div class="imgUsername notAccepted">';
										echo '<button type="button" class="button buttonplusminus"  onclick="removeUser('.$rowIdUsers["id_user"].', true)" id="removeU'.$rowIdUsers["id_user"].'"><img src="../image/minus.svg" id="minus" class="icon under"/></button>';
									}else if($rowIdUsers['priorityy']==1){
										echo '<div class="imgUsername">';
										echo '<button type="button" class="button buttonplusminus"  onclick="removeUser('.$rowIdUsers["id_user"].', true)" id="removeU'.$rowIdUsers["id_user"].'"><img src="../image/minus.svg" id="minus" class="icon under"/></button>';
									}else{
										echo '<div class="imgUsername"><button type="button" class="button buttonplusminus" onclick="addUser('.$rowIdUsers["id_user"].', true)" id="addU'.$rowIdUsers["id_user"].'"><img src="../image/plus.svg" id="plus" class="icon under"/></button>';
									}
								}else{
									if($rowIdUsers['priorityy']==2){
										echo '<div class="notAccepted">';
									}else{
										echo '<div class="imgUsername">';
									}
								}

								if($rowNameUsers['user_avatar']==1){
									echo "<img class='smallAvatar' src='../avatars/profile".$rowIdUsers['id_user'].".jpg?'".mt_rand().">";
								}else{
									echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
								}
								echo '<label>'.$rowNameUsers["user_login"].'</label>';
								if(((($eventDate<$date) || ($eventDate==$date && $startTime<$time)) && $endDate>$date && $canRate) && $rowIdUsers['priorityy']==1){
									echo '<button class="button" type="button" id="rateUser" onclick="rateUser('.$rowNameUsers["id_user"].',\''.$rowNameUsers["user_login"].'\')">Rate</button>';
								}else{
									echo '<button class="button" type="button" disabled>Rate</button>';
								}
								if(mysqli_num_rows($resultFindRateIfExist)==1){
									echo '<label>'.$rowFindRateIfExist["score"].'</label></div>';
								}else{
									echo '</div>';
								}
							}
						}else{

							if($rowIdUsers["id_user"] == $_SESSION['id']){
								if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
									if($rowIdUsers['priorityy']==2){
										echo '<div class="imgUsername notAccepted">';
									}else if($rowIdUsers['priorityy']==1){
										echo '<div class="imgUsername">';
									}else{
										echo '<div class="imgUsername">';
										echo '<button type="button" class="button buttonplusminus" onclick="addUser('.$rowIdUsers["id_user"].', false)" id="addU'.$rowIdUsers["id_user"].'"><img src="../image/plus.svg" id="plus" class="icon under"/></button>';
									}
									echo '<button type="button" class="button buttonplusminus"  onclick="removeUser('.$rowIdUsers["id_user"].', false)" id="removeU'.$rowIdUsers["id_user"].'"><img src="../image/minus.svg" id="minus" class="icon under"/></button>';
								}else{
									if($rowIdUsers['priorityy']==2){
										echo '<div class="notAccepted">';
									}else{
										echo '<div class="imgUsername">';
									}
								}
								if($rowNameUsers['user_avatar']==1){
									echo "<img class='smallAvatar' src='../avatars/profile".$rowIdUsers['id_user'].".jpg?'".mt_rand().">";
								}else{
									echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
								}
								echo $rowNameUsers["user_login"].'</div>';
							}else{
								if($rowIdUsers['priorityy']==2){
									echo '<div class="imgUsername notAccepted">';
									if($rowNameUsers['user_avatar']==1){
										echo "<img class='smallAvatar' src='../avatars/profile".$rowIdUsers['id_user'].".jpg?'".mt_rand().">";
									}else{
										echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
									}
								}else{
									echo '<div class="imgUsername">';
									if($rowNameUsers['user_avatar']==1){
										echo "<img class='smallAvatar' src='../avatars/profile".$rowIdUsers['id_user'].".jpg?'".mt_rand().">";
									}else{
										echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
									}
								}
								echo '<label>'.$rowNameUsers["user_login"].'</label>';
								if($_SESSION['id']){
									if(((($eventDate<$date) || ($eventDate==$date && $startTime<$time)) && $endDate>$date && $canRate) && $rowIdUsers['priorityy']==1){
										echo '<button class="button" type="button" id="rateUser" onclick="rateUser('.$rowNameUsers["id_user"].',\''.$rowNameUsers["user_login"].'\')">Rate</button>';
									}else {
										echo '<button class="button" type="button" disabled>Rate</button>';
									}
									if(mysqli_num_rows($resultFindRateIfExist)==1){
										echo '<label>'.$rowFindRateIfExist["score"].'</label></div>';
									}else{
										echo '</div>';
									}
								}else{
									echo '</div>';
								}
							}
						}
					}
					$rowNumber++;
					$count--;
				}
				$sqlOtherUsers = "SELECT id_user, user_login, user_avatar FROM user WHERE id_user NOT IN (".$allUsersInEvent.");";
				$resultOtherUsers = mysqli_query($conn, $sqlOtherUsers);
				
				if($initiator == $loginValue){
						echo '<br><br><h4>Add user</h4>';
						echo '<div id="otherUsers" class="scrollbar">';
					while($rowOtherUsers = mysqli_fetch_assoc($resultOtherUsers)){
						if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){			
							echo '<div class="imgUsername"><button type="button" class="button buttonplusminus" onclick="addUser('.$rowOtherUsers["id_user"].', true)" id="addU'.$rowIdUsers["id_user"].'"><img src="../image/plus.svg" id="plus" class="icon under"/></button>';
						}else{
							echo '<div>';
						}
						if($rowOtherUsers['user_avatar']==1){
							echo "<img class='smallAvatar' src='../avatars/profile".$rowOtherUsers['id_user'].".jpg?'".mt_rand().">";
						}else{
							echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
						}
						echo '<label>'.$rowOtherUsers["user_login"].'</label></div>';
					}
					echo '</div>';
				}else{
					while($rowOtherUsers = mysqli_fetch_assoc($resultOtherUsers)){
						if($rowOtherUsers['id_user']==$_SESSION['id']){
							if(($eventDate>$date) || ($eventDate==$date && $eventTime>$time)){
								echo '<div class="imgUsername"><button type="button" class="button buttonplusminus" onclick="addUser('.$rowOtherUsers["id_user"].', false)" id="addU'.$rowIdUsers["id_user"].'"><img src="../image/plus.svg" id="plus" class="icon under"/></button>';
							}else{
								echo '<div>';
							}
							if($rowOtherUsers['user_avatar']==1){
								echo "<img class='smallAvatar' src='../avatars/profile".$rowOtherUsers['id_user'].".jpg?'".mt_rand().">";
							}else{
								echo "<img class='smallAvatar' src='../avatars/profiledefault.jpg'>";
							}

							echo '<label>'.$rowOtherUsers["user_login"].'<label></div>';
						}
					}
				}

			echo '</div>';
		} else{
			echo '<script type="text/javascript"> eventNotFound(); </script>';
			
		}
	
	?>
</body>
	<script>
		function addUser(uid, isInitiator){
			evid = <?php echo $eventId;?>;
			if(isInitiator){
				window.location.href = 'dbAddUserIntoEvent.php?uid='+uid+'&evid='+evid+'';
			}else{
				window.location.href = 'joinEvent.php?evid='+evid+'';
			}
		}
		function removeUser(uid, isInitiator){
			evid = <?php echo $eventId;?>;
			if(isInitiator){
				window.location.href = 'dbDeleteUserFromEvent.php?uid='+uid+'&evid='+evid+'';
			}else{
				window.location.href = 'leaveEvent.php?evid='+evid+'';
			}
		}

		function rateUser(uid, uname){
			var modal = document.getElementById("ratingModal");
			document.getElementById("chosenUser").value=uid;
			var span = document.getElementById("ratespan");
			modal.style.display = "block";
			span.onclick = function() {
				modal.style.display = "none";
			}

			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		}	
	</script>
</html>