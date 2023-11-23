<?php

include("_session_start.php");
include("_dbconnect.php");


if(!isset($_POST['destination_state_row_id']) || empty($_POST['destination_state_row_id']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['destination_state_id']) || empty($_POST['destination_state_id']))
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


$destination_state_row_id=htmlspecialchars($_POST['destination_state_row_id']);
$destination_state_id=htmlspecialchars($_POST['destination_state_id']);
$destination_state_text=mysqli_real_escape_string($conn, $_POST['destination_state_text']);
$destination_state_min_temp=htmlspecialchars($_POST['destination_state_min_temp']);
$destination_state_max_temp=htmlspecialchars($_POST['destination_state_max_temp']);
$existing_destination_state_image=htmlspecialchars($_POST['existing_destination_state_image']);
$existing_destination_state_banner=htmlspecialchars($_POST['existing_destination_state_banner']);




//file handling 

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
            $sql="update destination_state set state_image='{$new_image_name}' where id={$destination_state_row_id} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                if (file_exists($existing_destination_state_image)) {
                    if (unlink($existing_destination_state_image)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                        // echo 1;
                    }
                }
            }
            else
            {
                if (file_exists($image_destination)) {
                    if (unlink($image_destination)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                    }
                }
                // echo 0;
            }
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
            $sql="update destination_state set banner_image='{$new_banner_name}' where id={$destination_state_row_id} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                if (file_exists($existing_destination_state_banner)) {
                    if (unlink($existing_destination_state_banner)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                        // echo 1;
                    }
                }
            }
            else
            {
                if (file_exists($banner_destination)) {
                    if (unlink($banner_destination)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                    }
                }
                // echo 0;
            }
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




// updating value in table if file is selected

$sql="update destination_state set state_id={$destination_state_id}, state_text='{$destination_state_text}', min_temp={$destination_state_min_temp}, max_temp={$destination_state_max_temp} where id={$destination_state_row_id} and is_deleted=0";

$result=mysqli_query($conn, $sql);

// $product_id=mysqli_insert_id($conn);

if($result)
{
    echo 1;
}
else
{
    echo 0;
}




// echo ($product_name." ".$product_price." ".$product_category." ".$file['name']." ".$destination);

?>