<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "knowledge_share";

    $conn = mysqli_connect($server,  $user, $password, $dbname);

    /* if(!$conn){
        die("connection failed".mysqli_connect_error());
    }
    else{
        echo "connection success!";
    }*/
?>