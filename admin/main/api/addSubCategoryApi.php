<?php

include("_session_start.php");
include("_dbconnect.php");

$category_id=$_POST['category_id'];
$sub_category_name=$_POST['sub_category_name'];
$sub_category_image = $_FILES['sub_category_image'];

// inserting value in table


$file_name = $sub_category_image['name'];
$file_tmp_name = $sub_category_image['tmp_name'];
$file_error = $sub_category_image['error'];

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

    if ($sub_category_image['size'] > $max_file_size) {
        echo 'File size exceeds the maximum limit of 5MB.';
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
        // inserting value in table
        
        $sql="insert into sub_category (name, category_id, sub_category_image) values ('{$sub_category_name}', {$category_id}, '{$new_file_name}')";

        $result=mysqli_query($conn, $sql);

        if($result)
        {
            echo 1;
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

?>