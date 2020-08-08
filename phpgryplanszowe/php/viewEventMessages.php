<?php
    session_start();
    include_once 'dbConnection.php';

    $result = array();
    $eventId = $_POST['eventId'];
    $evid =$_GET['evid'];
 
    $sqlSelectMsgs = "SELECT * FROM chat WHERE id_event=".$evid." ORDER BY id_chat ASC;";
    $resultSelectMsgs = mysqli_query($conn, $sqlSelectMsgs);
    while($row= mysqli_fetch_assoc($resultSelectMsgs)){
        echo $row;
    }
?>