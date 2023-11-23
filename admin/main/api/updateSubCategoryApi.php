<?php

include("_session_start.php");
include("_dbconnect.php");

$category_id=$_POST['category_id'];
$sub_category_id=$_POST['sub_category_id'];
$sub_category_name=$_POST['sub_category_name'];
$existing_sub_category_image=$_POST['existing_sub_category_image'];


//file handling

if(isset($_FILES['sub_category_image']) && $_FILES['sub_category_image']['error'] === UPLOAD_ERR_OK)
{
    $file = $_FILES['sub_category_image'];

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    
    if ($file_error === UPLOAD_ERR_OK) 
    {
        // Validate file type and size
        $allowed_extensions = array(
            'jpg',
            'jpeg',
            'png',
            'gif',
            'bmp',
            'tiff',
            'tif',
            'webp',
            'svg',
            'ico',
            'psd',
            'eps',
            'ai'
        );
        $max_file_size = 5 * 1024 * 1024; // 5MB
    
        $file_info = pathinfo($file_name);
        $file_extension = strtolower($file_info['extension']);
    
        if (!in_array($file_extension, $allowed_extensions)) {
            echo 'Invalid file format';
            exit;
        }
    
        if ($file['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 10MB.';
            exit;
        }
    
        // Generate a unique filename
        $new_file_name = uniqid('', true) . '.' . $file_extension;
    
        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/sub-category/';
    
        // Move the file to the upload directory
        $destination = $upload_directory . $new_file_name;
        if (move_uploaded_file($file_tmp_name, $destination)) 
        {
            // updating value in table if file is selected

            $sql="update sub_category set name='{$sub_category_name}', category_id={$category_id}, sub_category_image='{$new_file_name}' where sub_category_id={$sub_category_id} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                if (file_exists($existing_sub_category_image)) {
                    if (unlink($existing_sub_category_image)) {
                        // File deletion successfull
                        // echo 'File deleted successfully.';
                        echo 1;
                    } else {
                        // File deletion failed
                        // echo 'Failed to delete the file.';
                    }
                } else {
                    // File does not exist
                    // echo 'File not found.';
                }
            }
            else
            {
                if (file_exists($destination)) {
                    if (unlink($destination)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                    } else {
                        // File deletion failed
                        // echo 'Failed to delete the file.';
                    }
                } else {
                    // File does not exist
                    // echo 'File not found.';
                }
                echo 0;
            }
            
        } 
        else 
        {
            echo 'Failed to move the uploaded file.';
            exit;
        }
    } 
    else 
    {
        echo 'File upload failed';
        exit;
    }    
}
else
{
    // updating value in table if file not is selected

    $sql="update sub_category set name='{$sub_category_name}', category_id={$category_id} where sub_category_id={$sub_category_id} and is_deleted=0";

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





?>