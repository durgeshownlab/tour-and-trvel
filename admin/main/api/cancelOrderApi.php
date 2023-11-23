<?php 

include("_session_start.php");
include("_dbconnect.php");

try
{

    $order_id=$_POST['order_id'];

    $sql = "select order_event from orders where order_id='{$order_id}'";
    $result = mysqli_query($conn, $sql);


    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $order_event_data=json_decode($row['order_event']);
    }

    date_default_timezone_set("Asia/kolkata");

    $order_event_data[] =
        [
          'event_name' => 'order canceled',
          'Date' => date('d-m-Y'),
          'Time' => date('H:i:s')
        ];

    $json_order_event_data = json_encode($order_event_data);


    $sql="update orders set is_canceled=1, order_status='canceled', delivery_status='canceled', order_event='{$json_order_event_data}' where order_id='{$order_id}' and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

}
catch(Exception $e)
{
    echo'<script>console.log("'.$e.'");</script>';
}
finally
{
    mysqli_close($conn);
}

?>