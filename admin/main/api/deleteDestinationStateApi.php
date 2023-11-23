<?php 

include("_session_start.php");
include("_dbconnect.php");

try
{
    
    $sql="update destination_state set is_deleted=1 where id={$_POST['destination_state_id']} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
       echo 1;
    }
    else
    {
        echo 0;
        exit;
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