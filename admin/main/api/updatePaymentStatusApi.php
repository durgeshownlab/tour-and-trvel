<?php

    include("_session_start.php");
    include("_dbconnect.php");

    $order_id=$_POST['order_id'];
    $payment_status='success';

    // code for getting all ready stored event 
    $sql="update orders set payment_status='{$payment_status}' where order_id='{$order_id}' and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
?>