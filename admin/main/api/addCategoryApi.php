<?php

include("_session_start.php");
include("_dbconnect.php");


if(!isset($_POST['category_name']) || empty($_POST['category_name']))
{
    echo 0;
    exit;
}
else if(!isset($_FILES['category_image']))
{
    echo 0;
    exit;
}
else if(!isset($_FILES['category_icon']))
{
    echo 0;
    exit;
}
else if(!isset($_FILES['category_banner']))
{
    echo 0;
    exit;
}


$category_name=htmlspecialchars($_POST['category_name']);
//icon file handling

if(isset($_FILES['category_icon']) && $_FILES['category_icon']['error'] === UPLOAD_ERR_OK)
{

    $category_icon = $_FILES['category_icon'];

    $file_name = $category_icon['name'];
    $file_tmp_name = $category_icon['tmp_name'];
    $file_error = $category_icon['error'];

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

        if ($category_icon['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 5MB.';
            exit;
        }

        // Generate a unique filename
        $new_icon_name = uniqid('', true) . '.' . $file_extension;

        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/category/';

        // Move the file to the upload directory
        $icon_destination = $upload_directory . $new_icon_name;
        if (move_uploaded_file($file_tmp_name, $icon_destination)) 
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

if(isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK)
{
    //image file handling 
    $category_image = $_FILES['category_image'];

    $file_name = $category_image['name'];
    $file_tmp_name = $category_image['tmp_name'];
    $file_error = $category_image['error'];

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

        if ($category_image['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 5MB.';
            exit;
        }

        // Generate a unique filename
        $new_file_name = uniqid('', true) . '.' . $file_extension;

        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/category/';

        // Move the file to the upload directory
        $image_destination = $upload_directory . $new_file_name;
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

if(isset($_FILES['category_banner']) && $_FILES['category_banner']['error'] === UPLOAD_ERR_OK)
{
    //image file handling 
    $category_banner = $_FILES['category_banner'];

    $file_name = $category_banner['name'];
    $file_tmp_name = $category_banner['tmp_name'];
    $file_error = $category_banner['error'];

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

        if ($category_banner['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 5MB.';
            exit;
        }

        // Generate a unique filename
        $new_banner_name = uniqid('', true) . '.' . $file_extension;

        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/category/';

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
$sql="insert into category (name, image, icon, banner) values ('{$category_name}', '{$new_file_name}', '{$new_icon_name}', '{$new_banner_name}')";

$result=mysqli_query($conn, $sql);

if($result)
{
    echo 1;
}
else
{
    if (file_exists($icon_destination)) {
        if (unlink($icon_destination)) {
            // File deletion successful
            // echo 'File deleted successfully.';
            // echo 1;
        }
    }
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