<?php

include("_session_start.php");
include("_dbconnect.php");


if(!isset($_POST['category_name']) || empty($_POST['category_name']))
{
    echo 0;
    exit;
}
if(!isset($_POST['category_id']) || empty($_POST['category_id']))
{
    echo 0;
    exit;
}


$category_id=$_POST['category_id'];
$category_name=htmlspecialchars($_POST['category_name']);
$existing_category_image=$_POST['existing_category_image'];
$existing_category_icon=$_POST['existing_category_icon'];
$existing_category_banner=$_POST['existing_category_banner'];


//file handling 

if(isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK)
{
    // echo"<script>console.log(".implode(" ",$file).")</script>";
    $file = $_FILES['category_image'];

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
        $upload_directory = '../../../images/category/';
    
        // Move the file to the upload directory
        $image_destination = $upload_directory . $new_file_name;
        if (move_uploaded_file($file_tmp_name, $image_destination)) 
        {
            // updating value in table if file is selected

            $sql="update category set image='{$new_file_name}' where id={$category_id} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                if (file_exists($existing_category_image)) {
                    if (unlink($existing_category_image)) {
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


if(isset($_FILES['category_icon']) && $_FILES['category_icon']['error'] === UPLOAD_ERR_OK)
{
    // echo"<script>console.log(".implode(" ",$file).")</script>";
    $file = $_FILES['category_icon'];

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
        $new_icon_name = uniqid('', true) . '.' . $file_extension;
    
        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/category/';
    
        // Move the file to the upload directory
        $icon_destination = $upload_directory . $new_icon_name;
        if (move_uploaded_file($file_tmp_name, $icon_destination)) 
        {
            // updating value in table if file is selected

            $sql="update category set icon='{$new_icon_name}' where id={$category_id} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                if (file_exists($existing_category_icon)) {
                    if (unlink($existing_category_icon)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                        // echo 1;
                    }
                } 
            }
            else
            {
                if (file_exists($icon_destination)) {
                    if (unlink($icon_destination)) {
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


if(isset($_FILES['category_banner']) && $_FILES['category_banner']['error'] === UPLOAD_ERR_OK)
{
    // echo"<script>console.log(".implode(" ",$file).")</script>";
    $file = $_FILES['category_banner'];

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
        $new_banner_name = uniqid('', true) . '.' . $file_extension;
    
        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/category/';
    
        // Move the file to the upload directory
        $banner_destination = $upload_directory . $new_banner_name;
        if (move_uploaded_file($file_tmp_name, $banner_destination)) 
        {
             // updating value in table if file is selected

             $sql="update category set banner='{$new_banner_name}' where id={$category_id} and is_deleted=0";
            
             $result=mysqli_query($conn, $sql);
             
             if($result)
             {
                 if (file_exists($existing_category_banner)) {
                     if (unlink($existing_category_banner)) {
                         // File deletion successful
                         // echo 'File deleted successfully.';
                        //  echo 1;
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
                //  echo 0;
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

$sql="update category set name='{$category_name}' where id={$category_id} and is_deleted=0";

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