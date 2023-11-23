<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $sql="update packages set is_deleted=1 where package_id={$_POST['package_id']}";
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