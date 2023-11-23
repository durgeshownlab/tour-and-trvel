<?php

include("_session_start.php");
include("_dbconnect.php");


if(!isset($_POST['destination_state_id']) || empty($_POST['destination_state_id']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['destination_state_text']) || empty($_POST['destination_state_text']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['destination_state_min_temp']) || empty($_POST['destination_state_min_temp']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['destination_state_max_temp']) || empty($_POST['destination_state_max_temp']))
{
    echo 0;
    exit;
}
else if(!isset($_FILES['destination_state_image']))
{
    echo 0;
    exit;
}
else if(!isset($_FILES['destination_state_banner']))
{
    echo 0;
    exit;
}


$destination_state_id=mysqli_real_escape_string($conn, $_POST['destination_state_id']);
$destination_state_text=mysqli_real_escape_string($conn, $_POST['destination_state_text']);
$destination_state_min_temp=mysqli_real_escape_string($conn, $_POST['destination_state_min_temp']);
$destination_state_max_temp=mysqli_real_escape_string($conn, $_POST['destination_state_max_temp']);
//icon file handling

if(isset($_FILES['destination_state_image']) && $_FILES['destination_state_image']['error'] === UPLOAD_ERR_OK)
{

    $destination_state_image = $_FILES['destination_state_image'];

    $file_name = $destination_state_image['name'];
    $file_tmp_name = $destination_state_image['tmp_name'];
    $file_error = $destination_state_image['error'];

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

        if ($destination_state_image['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 5MB.';
            exit;
        }

        // Generate a unique filename
        $new_image_name = uniqid('', true) . '.' . $file_extension;

        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/destination_state/';

        // Move the file to the upload directory
        $image_destination = $upload_directory . $new_image_name;
        if (move_uploaded_file($file_tmp_name, $image_destination)) 
        {
            
        } 
        else 
        {
            // echo 'Failed to move the uploaded file.';
            // exit;
        }
    } 
    else 
    {
        // echo 'File upload failed';
        // exit;
    }
}

if(isset($_FILES['destination_state_banner']) && $_FILES['destination_state_banner']['error'] === UPLOAD_ERR_OK)
{
    //image file handling 
    $destination_state_banner = $_FILES['destination_state_banner'];

    $file_name = $destination_state_banner['name'];
    $file_tmp_name = $destination_state_banner['tmp_name'];
    $file_error = $destination_state_banner['error'];

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

        if ($destination_state_banner['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 5MB.';
            exit;
        }

        // Generate a unique filename
        $new_banner_name = uniqid('', true) . '.' . $file_extension;

        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/destination_state/';

        // Move the file to the upload directory
        $banner_destination = $upload_directory . $new_banner_name;
        if (move_uploaded_file($file_tmp_name, $banner_destination)) 
        {
            
        } 
        else 
        {
            // echo 'Failed to move the uploaded file.';
            // exit;
        }
    } 
    else 
    {
        // echo 'File upload failed';
        // exit;
    }
}


// inserting value in table
$sql="insert into destination_state (state_id, state_text, min_temp, max_temp, state_image, banner_image) values ('{$destination_state_id}', '{$destination_state_text}', '{$destination_state_min_temp}', '{$destination_state_max_temp}', '{$new_image_name}', '{$new_banner_name}')";

$result=mysqli_query($conn, $sql);

if($result)
{
    echo 1;
}
else
{
    if (file_exists($image_destination)) {
        if (unlink($image_destination)) {
            // File deletion successful
            // echo 'File deleted successfully.';
            // echo 1;
        }
    }
    if (file_exists($banner_destination)) {
        if (unlink($banner_destination)) {
            // File deletion successful
            // echo 'File deleted successfully.';
            // echo 1;
        }
    }
    echo 0;
}

?>