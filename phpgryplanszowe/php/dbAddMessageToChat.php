<?php
    session_start();
    include_once 'dbConnection.php';

    $result = array();
    $eventId = $_POST['eventId'];
    $username =$_POST['from'];
    $textMessage =$_POST['chatMessage'];
    $textMessage = nl2br($textMessage);

    if(!empty($textMessage) && !empty($username)){
        $sqlFindEvent = "SELECT * FROM event_user WHERE id_event=".$eventId." AND id_user=".$_SESSION['id'].";";
        $resultFindEvent = mysqli_query($conn, $sqlFindEvent);
        if(mysqli_num_rows($resultFindEvent)==1){
            $sql = "INSERT INTO chat (id_event, user_login, text_message) VALUES ('".$eventId."', '".$username."', '".$textMessage."' );";
            $result['send_status'] = $conn->query($sql);
        }else{
            header("Location: homePage.php");
        }
    }
    $start =isset($_GET['start']) ? intval($_GET['start']) : 0;
    $evid =isset($_GET['evid']) ? intval($_GET['evid']) : 0;
    $sqlSelectMsgs = "SELECT * FROM chat WHERE id_chat >".$start." AND id_event=".$evid.";";
    $items = mysqli_query($conn, $sqlSelectMsgs);
    while($row= mysqli_fetch_assoc($items)){
        $result['items'][] = $row;
        
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    echo json_encode($result);
?>