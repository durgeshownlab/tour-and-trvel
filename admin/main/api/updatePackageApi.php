<?php

include("_session_start.php");
include("_dbconnect.php");

if(!isset($_POST['package_name']) || empty($_POST['package_name']))
{
    echo 0;
    exit;
}
if(!isset($_POST['package_price']) || empty($_POST['package_price']) || !is_numeric($_POST['package_price']) || $_POST['package_price']<0)
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_price']) || empty($_POST['package_price']) || !is_numeric($_POST['package_price']) || $_POST['package_price']<0)
{
    echo 0;
    exit;
}
else if($_POST['package_price']>$_POST['package_base_price'])
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_category']) || empty($_POST['package_category']))
{
    echo 0;
    exit;
}


else if(!isset($_POST['package_duration']) || empty($_POST['package_duration']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_country']) || empty($_POST['package_country']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_state']) || empty($_POST['package_state']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_city']) || empty($_POST['package_city']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_best_month']) || empty($_POST['package_best_month']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_included']) || empty($_POST['package_included']))
{
    echo 0;
    exit;
}
else if(!isset($_POST['package_type']) || empty($_POST['package_type']))
{
    echo 0;
    exit;
}


else if(!isset($_POST['package_desc']) || empty($_POST['package_desc']))
{
    echo 0;
    exit;
}
 
$status=true;

//file handling 
// when only main is selected and others image is not selected 
if(isset($_FILES['package_main_image']) && $_FILES['package_main_image']['error'] === UPLOAD_ERR_OK)
{

    //file handling 
    $package_main_image = $_FILES['package_main_image'];

    $file_name = $package_main_image['name'];
    $file_tmp_name = $package_main_image['tmp_name'];
    $file_error = $package_main_image['error'];

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

        if ($package_main_image['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 5MB.';
            exit;
        }

        // Generate a unique filename
        $new_file_name = uniqid('', true) . '.' . $file_extension;

        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/packages/';

        // Move the file to the upload directory
        $destination = $upload_directory . $new_file_name;
        if (move_uploaded_file($file_tmp_name, $destination)) 
        {
            // updating value in table if file is selected
           
            $sql="update packages set main_image='{$new_file_name}' where package_id={$_POST['package_id']} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                $existing_package_image_path='../../../images/packages/'.$_POST['existing_package_image_path'];
                if (file_exists($existing_package_image_path)) {
                    if (unlink($existing_package_image_path)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                        // echo 1;
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
                // echo 0;
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

// when only other images is selected and main image is not selected 
if(isset($_FILES['package_other_image']) && is_array($_FILES["package_other_image"]))
{
    $upload_status=true;
    if (isset($_FILES["package_other_image"]) && is_array($_FILES["package_other_image"])) {

        // Loop through the uploaded files
        for($i = 0; $i < count($_FILES["package_other_image"]["name"]); $i++) {

            $file_name = $_FILES["package_other_image"]["name"][$i];
            $file_tmp_name = $_FILES["package_other_image"]["tmp_name"][$i];
            $file_size = $_FILES["package_other_image"]["size"][$i];
            $file_error = $_FILES["package_other_image"]["error"][$i];

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

                if ($file_size > $max_file_size) {
                    echo 'File size exceeds the maximum limit of 5MB.';
                    exit;
                }

                // Generate a unique filename
                $new_file_name = uniqid('', true) . '.' . $file_extension;

                // Specify the directory to which the file should be moved
                $upload_directory = '../../../images/packages/';

                // Move the file to the upload directory
                $destination = $upload_directory . $new_file_name;
                if (move_uploaded_file($file_tmp_name, $destination)) 
                {
                    $sql="insert into package_images (package_id, image_path) values ({$_POST['package_id']}, '{$new_file_name}')";

                    $result=mysqli_query($conn, $sql);

                    if(!$result)
                    {
                        $upload_status=false;
                        break;
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
    }
    
}

// when only main is selected and others image is not selected 
if(isset($_FILES['package_banner_image']) && $_FILES['package_banner_image']['error'] === UPLOAD_ERR_OK)
{

    //file handling 
    $package_banner_image = $_FILES['package_banner_image'];

    $file_name = $package_banner_image['name'];
    $file_tmp_name = $package_banner_image['tmp_name'];
    $file_error = $package_banner_image['error'];

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

        if ($package_banner_image['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 5MB.';
            exit;
        }

        // Generate a unique filename
        $new_file_name = uniqid('', true) . '.' . $file_extension;

        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/packages/';

        // Move the file to the upload directory
        $destination = $upload_directory . $new_file_name;
        if (move_uploaded_file($file_tmp_name, $destination)) 
        {
            // updating value in table if file is selected
                        

            $sql="update packages set banner_image='{$new_file_name}' where package_id={$_POST['package_id']} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                $existing_package_banner_image_path='../../../images/packages/'.$_POST['existing_package_banner_image_path'];
                if (file_exists($existing_package_banner_image_path)) {
                    if (unlink($existing_package_banner_image_path)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                        // echo 1;
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




// updating value in table 

$package_name=mysqli_real_escape_string($conn, $_POST['package_name']);
$package_category=mysqli_real_escape_string($conn, $_POST['package_category']);
$package_old_price=mysqli_real_escape_string($conn, $_POST['package_base_price']);
$package_new_price=mysqli_real_escape_string($conn, $_POST['package_price']);

$package_duration=mysqli_real_escape_string($conn, $_POST['package_duration']);
$package_country=mysqli_real_escape_string($conn, $_POST['package_country']);
$package_state=mysqli_real_escape_string($conn, $_POST['package_state']);
$package_city=mysqli_real_escape_string($conn, $_POST['package_city']);
$package_best_month=mysqli_real_escape_string($conn, $_POST['package_best_month']);
$package_included=mysqli_real_escape_string($conn, $_POST['package_included']);
$package_type=mysqli_real_escape_string($conn, $_POST['package_type']);

$package_location_link=mysqli_real_escape_string($conn, $_POST['package_location_link']);

$package_desc = mysqli_real_escape_string($conn, $_POST['package_desc']);

$sql="update packages set name='{$package_name}', new_price={$package_new_price}, description='{$package_desc}', category_id={$package_category}, old_price={$package_old_price}, tour_duration={$package_duration}, country='{$package_country}', state='{$package_state}', city='{$package_city}', best_month='{$package_best_month}', included='{$package_included}', type='{$package_type}', location_link='{$package_location_link}' where package_id={$_POST['package_id']} and is_deleted=0";
        
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