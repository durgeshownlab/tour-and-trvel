<?php 

include("_session_start.php");
include("_dbconnect.php");

try
{

    $sub_category_id=$_POST['sub_category_id'];

    $sql="update sub_category set is_deleted=1 where sub_category_id={$sub_category_id} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        
        $sql="select * from products where sub_category_id={$sub_category_id} and is_deleted=0";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0)
        {
            $sql="update products set is_deleted=1 where sub_category_id={$sub_category_id} and is_deleted=0";
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
        else
        {
            echo 1;
        }
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