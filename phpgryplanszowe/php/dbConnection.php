<?php
    $user = 'mpr_phpgryplanszowe';
    

    $conn = mysqli_connect("localhost", "root", "", $user);
     if( $conn ){
     }else{
          echo "connection error: " . mysqli_connect_error();
     }
?>