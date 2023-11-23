<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $sql="select * from package_images where id={$_POST['image_id']} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
    }

    $destination = '../../../images/packages/'.$row['image_path'];
    
    $sql="delete from package_images where id={$_POST['image_id']} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        if (file_exists($destination)) {
            if (unlink($destination)) {
                // File deletion successful
                // echo 'File deleted successfully.';
                echo 1;
                exit;
            } 
            else {
                // File deletion failed
                // echo 'Failed to delete the file.';
            }
        } 
        else {
            // File does not exist
            // echo 'File not found.';
        }
        echo 1;
    }
    else
    {
        echo 0;
    }

?>