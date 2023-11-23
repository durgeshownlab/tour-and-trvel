<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $sql_image = "select * from package_images where package_id={$_POST['package_id']} and is_deleted=0";
    $result_image=mysqli_query($conn, $sql_image);

    $output = '';

    if(mysqli_num_rows($result_image)>0)
    {
        while($row_image=mysqli_fetch_assoc($result_image))
        {
            $output .='
                <div class="position-relative">
                    <img src="../../images/packages/'.$row_image['image_path'].'" class="img-fluid rounded p-2" alt="" style="width: auto; height: 100px; max-height: 200px; max-width: 200px;">
                    <span class="bg-danger p-1 rounded position-absolute image-delete-btn" style="z-index: 9; top: 10px; right: 10%; cursor:pointer;" data-image-id="'.$row_image['id'].'" data-package-id="'.$_POST['package_id'].'">
                        <i class="fa fa-trash"></i>
                    </span>
                </div>';
        }
    }

    echo $output;
?>