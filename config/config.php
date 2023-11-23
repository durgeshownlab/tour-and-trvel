<?php
$con=mysqli_connect("localhost","root","","tour_and_travel");
if(mysqli_connect_errno())
{
    echo "Failled to connect" . $mysqli_connect_error();
    exit();
}

?>