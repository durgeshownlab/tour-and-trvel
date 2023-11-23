<?php
    $host="localhost";
    $uname="root";
    $pass="";
    $database="tour_and_travel";

    $conn=mysqli_connect($host, $uname, $pass, $database);

    if($conn){
        
    }
    else{
        die("Connection failed !");
    }
?>