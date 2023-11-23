<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $sql="update banners set is_deleted=1 where banner_id={$_POST['banner_id']}";
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